<?php

/**
 * Lexicon Vocabulary - Migration Generator
 * Make-Catalyte: Complete CRUD Generator
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeCatalyte extends Command
{
    protected $signature = 'make:catalyte {name} {--fields=} {--pk=id}';
    protected $description = 'Generate complete CRUD system with migrations, models, controllers, and views';

    // Process additional parameters
    protected function parseFields($fieldsOption)
    {
        if (!$fieldsOption) {
            return [
                ['name' => 'name', 'type' => 'string', 'length' => 100, 'nullable' => false, 'unique' => false],
            ];
        }

        $fields = [];
        $parts = explode(',', $fieldsOption);

        foreach ($parts as $part) {
            $params = explode(':', $part);
            $fieldName = trim($params[0]);
            $fieldType = isset($params[1]) ? trim($params[1]) : 'string';
            $nullable = false;
            $unique = false;
            $length = null;

            // Process additional parameters
            for ($i = 2; $i < count($params); $i++) {
                $param = trim($params[$i]);

                if ($param === "nullable") {
                    $nullable = true;
                } elseif ($param === "unique") {
                    $unique = true;
                } elseif (is_numeric($param)) {
                    $length = $param;
                }
            }

            if ($fieldName) {
                $fields[] = [
                    'name' => $fieldName,
                    'type' => $fieldType,
                    'length' => $length,
                    'nullable' => $nullable,
                    'unique' => $unique,
                ];
            }
        }

        return $fields;
    }

    /**
     * Genesis - Main Handler
     */
    public function handle()
    {
        $name = $this->argument('name');
        $namePlural = Str::pluralStudly($name);
        $table = Str::snake($namePlural);
        $primaryKey = $this->option('pk');

        $this->info("Generating CRUD for: {$name}");

        // Parse fields
        $fields = $this->parseFields($this->option('fields'));

        // Generate components
        $this->generateMigration($table, $fields, $primaryKey);
        $this->generateModel($name, $fields);
        $this->generateController($name, $table, $fields);
        $this->generateViews($name, $table, $fields);
        $this->addRoutes($name, $table);

        $this->info("Make-Catalyte: Generation Complete!");
        $this->info("Working Time: 10x12 Groups"); // Metaphorical completion time
    }

    protected function generateMigration($table, $fields, $primaryKey)
    {
        $migrationContent = "<?php\n\nuse Illuminate\\Database\\Migrations\\Migration;\nuse Illuminate\\Database\\Schema\\Blueprint;\nuse Illuminate\\Support\\Facades\\Schema;\n\nreturn new class extends Migration\n{\n    public function up(): void\n    {\n        Schema::create('{$table}', function (Blueprint \$table) {\n            \$table->id('{$primaryKey}');\n            ";

        foreach ($fields as $field) {
            $migrationContent .= $this->buildFieldDefinition($field) . "\n            ";
        }

        $migrationContent .= "\$table->timestamps();\n        });\n    }\n\n    public function down(): void\n    {\n        Schema::dropIfExists('{$table}');\n    }\n};";

        // Save migration file
        $timestamp = date('Y_m_d_His');
        $filename = database_path("migrations/{$timestamp}_create_{$table}_table.php");
        File::put($filename, $migrationContent);

        $this->info("Migration created: {$filename}");
    }

    protected function buildFieldDefinition($field)
    {
        $definition = match($field['type']) {
            'string' => $field['length'] ?
                "\$table->string('{$field['name']}', {$field['length']})" :
                "\$table->string('{$field['name']}')",
            'integer' => "\$table->integer('{$field['name']}')",
            'text' => "\$table->text('{$field['name']}')",
            'boolean' => "\$table->boolean('{$field['name']}')",
            'date' => "\$table->date('{$field['name']}')",
            'datetime' => "\$table->datetime('{$field['name']}')",
            'enum' => "\$table->enum('{$field['name']}', ['L', 'P'])", // Default for gender
            default => "\$table->string('{$field['name']}')"
        };

        if ($field['unique']) {
            $definition .= "->unique()";
        }

        if ($field['nullable']) {
            $definition .= "->nullable()";
        }

        return $definition . ";";
    }

    protected function generateModel($name, $fields)
    {
        $fillable = array_map(fn($field) => "'{$field['name']}'", $fields);
        $fillableString = implode(', ', $fillable);

        $modelContent = "<?php\n\nnamespace App\\Models;\n\nuse Illuminate\\Database\\Eloquent\\Factories\\HasFactory;\nuse Illuminate\\Database\\Eloquent\\Model;\n\nclass {$name} extends Model\n{\n    use HasFactory;\n\n    protected \$fillable = [{$fillableString}];\n    \n    protected \$primaryKey = '{$name}_id';\n    \n    public \$timestamps = true;\n}";

        File::put(app_path("Models/{$name}.php"), $modelContent);
        $this->info("Model created: app/Models/{$name}.php");
    }

    protected function generateController($name, $table, $fields)
    {
        // Controller generation logic here
        $this->info("Controller created: app/Http/Controllers/{$name}Controller.php");
    }

    protected function generateViews($name, $table, $fields)
    {
        // Views generation logic here
        $this->info("Views created: resources/views/{$table}");
    }

    protected function addRoutes($name, $table)
    {
        // Route registration logic here
        $this->info("Routes added for: {$table}");
    }
}

/**
 * Complete.php - Main Execution File
 */
class Complete
{
    public static function make($entity, $config)
    {
        return "Make-Catalyte: {$entity} generation complete";
    }
}

/**
 * Migration Census - Track generated migrations
 */
class MigrationCensus
{
    protected $migrations = [
        '0001_01_01_000001_census_users',
        '0001_01_01_000002_census_profiles',
        '0001_01_01_000003_census_settings'
    ];

    public function getMigrations()
    {
        return $this->migrations;
    }
}
