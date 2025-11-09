<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeCrud extends Command
{
    // contoh:
    // php artisan make:crud LembagaDesa --fields="nama_lembaga:string:100,deskripsi:string:225,kontak:string:nullable"
    protected $signature = 'make:crud {name} {--fields=}';
    protected $description = 'Generate CRUD (model, migration, controller, views, route) for given name with dynamic fields';

    public function handle()
    {
        $name = $this->argument('name');
        $namePlural = Str::pluralStudly($name);
        $table = Str::snake($namePlural);
        $modelFqn = "App\\Models\\{$name}";

        // 1. parse fields
        $fields = $this->parseFields($this->option('fields'));

        // 2. make model + migration
        $this->call('make:model', [
            'name' => $name,
            '--migration' => true,
        ]);

        // 3. rewrite migration
        $this->updateMigration($table, $fields);

        // 4. make controller
        $this->call('make:controller', [
            'name' => "{$name}Controller",
            '--resource' => true
        ]);

        $this->updateController($name, $table, $modelFqn, $fields);

        // 5. make views
        $this->makeViews($name, $table, $fields);

        // 6. append route
        $this->appendRoute($name, $table);

        $this->info("CRUD for {$name} generated successfully.");
    }

    protected function parseFields($fieldsOption)
    {
        if (!$fieldsOption) {
            return [
                ['name' => 'nama_lembaga', 'type' => 'string', 'length' => 100],
                ['name' => 'deskripsi', 'type' => 'string', 'length' => 225],
                ['name' => 'kontak', 'type' => 'string', 'nullable' => true],
            ];
        }

        $fields = [];
        $parts = explode(',', $fieldsOption);
        foreach ($parts as $part) {
            $pair = explode(':', $part);
            $fieldName = trim($pair[0]);
            $fieldType = isset($pair[1]) ? trim($pair[1]) : 'string';
            $fieldLength = null;
            $nullable = false;

            // Handle length specification
            if (isset($pair[2])) {
                if ($pair[2] === 'nullable') {
                    $nullable = true;
                } else {
                    $fieldLength = trim($pair[2]);
                }
            }

            // Handle nullable in any position
            if (isset($pair[3]) && $pair[3] === 'nullable') {
                $nullable = true;
            }

            if ($fieldName) {
                $fields[] = [
                    'name' => $fieldName,
                    'type' => $fieldType,
                    'length' => $fieldLength,
                    'nullable' => $nullable,
                ];
            }
        }
        return $fields;
    }

    protected function updateMigration($table, $fields)
    {
        $migrations = File::files(database_path('migrations'));
        $targetFile = null;
        foreach ($migrations as $migration) {
            if (str_contains($migration->getFilename(), "create_{$table}_table")) {
                $targetFile = $migration->getPathname();
                break;
            }
        }

        if (!$targetFile) {
            $this->error('Migration file not found.');
            return;
        }

        $fieldsMigration = "";
        foreach ($fields as $field) {
            $fieldsMigration .= $this->fieldToMigration($field) . "\n            ";
        }

        $stub = <<<PHP
public function up(): void
{
    Schema::create('$table', function (Blueprint \$table) {
        \$table->id('lembaga_id');
        {$fieldsMigration}\$table->timestamps();
    });
}
PHP;

        $content = File::get($targetFile);
        $content = preg_replace(
            '/public function up\(\): void\s*\{[\s\S]*?\}/',
            $stub,
            $content
        );
        File::put($targetFile, $content);
    }

    protected function fieldToMigration($field)
    {
        $name = $field['name'];
        $type = $field['type'];
        $length = $field['length'];
        $nullable = $field['nullable'];

        $migration = match ($type) {
            'string'    => $length ? "\$table->string('$name', $length)" : "\$table->string('$name')",
            'integer'   => "\$table->integer('$name')",
            'text'      => "\$table->text('$name')",
            'boolean'   => "\$table->boolean('$name')->default(false)",
            'date'      => "\$table->date('$name')",
            'datetime'  => "\$table->dateTime('$name')",
            'decimal'   => "\$table->decimal('$name', 10, 2)->default(0)",
            default     => "\$table->string('$name')",
        };

        if ($nullable) {
            $migration .= "->nullable()";
        }

        return $migration . ";";
    }

    protected function updateController($name, $table, $modelFqn, $fields)
    {
        $controllerPath = app_path("Http/Controllers/{$name}Controller.php");
        if (!File::exists($controllerPath)) {
            $this->error('Controller not found.');
            return;
        }

        $modelVar = Str::camel($name);
        $modelVarPlural = Str::plural($modelVar);

        $rules = "";
        foreach ($fields as $field) {
            $rules .= $this->fieldToValidation($field) . "\n            ";
        }

        $fillable = array_map(fn($f) => "'".$f['name']."'", $fields);
        $fillableString = implode(', ', $fillable);

        $controllerTemplate = <<<PHP
<?php

namespace App\Http\Controllers;

use $modelFqn;
use Illuminate\Http\Request;

class {$name}Controller extends Controller
{
    public function index()
    {
        // server-side pagination Laravel
        \${$modelVarPlural} = {$name}::latest()->paginate(10);
        return view('{$table}.index', compact('{$modelVarPlural}'));
    }

    public function create()
    {
        return view('{$table}.create');
    }

    public function store(Request \$request)
    {
        \$data = \$request->validate([
            {$rules}
        ]);

        {$name}::create(\$data);

        return redirect()->route('{$table}.index')->with('success', '{$name} created.');
    }

    public function show({$name} \${$modelVar})
    {
        return view('{$table}.show', compact('{$modelVar}'));
    }

    public function edit({$name} \${$modelVar})
    {
        return view('{$table}.edit', compact('{$modelVar}'));
    }

    public function update(Request \$request, {$name} \${$modelVar})
    {
        \$data = \$request->validate([
            {$rules}
        ]);

        \${$modelVar}->update(\$data);

        return redirect()->route('{$table}.index')->with('success', '{$name} updated.');
    }

    public function destroy({$name} \${$modelVar})
    {
        \${$modelVar}->delete();
        return redirect()->route('{$table}.index')->with('success', '{$name} deleted.');
    }
}
PHP;

        File::put($controllerPath, $controllerTemplate);

        $this->updateModelFillable($name, $fillableString);
    }

    protected function fieldToValidation($field)
    {
        $name = $field['name'];
        $nullable = $field['nullable'];
        
        $required = $nullable ? 'nullable' : 'required';

        return match ($field['type']) {
            'integer'   => "'$name' => '$required|integer',",
            'text'      => "'$name' => '$nullable|string',",
            'boolean'   => "'$name' => 'boolean',",
            'date'      => "'$name' => '$nullable|date',",
            'datetime'  => "'$name' => '$nullable|date',",
            'decimal'   => "'$name' => '$required|numeric',",
            default     => $field['length'] ? 
                "'$name' => '$required|string|max:{$field['length']}'," : 
                "'$name' => '$required|string|max:255',",
        };
    }

    protected function updateModelFillable($name, $fillableString)
    {
        $modelPath = app_path("Models/{$name}.php");
        if (!File::exists($modelPath)) return;

        $content = File::get($modelPath);

        if (!str_contains($content, 'fillable')) {
            $fillable = <<<PHP

    protected \$fillable = [$fillableString];
PHP;
            $content = str_replace("use HasFactory;\n", "use HasFactory;$fillable\n", $content);
            File::put($modelPath, $content);
        }
    }

    protected function makeViews($name, $table, $fields)
    {
        $viewsPath = resource_path("views/{$table}");
        if (!File::exists($viewsPath)) {
            File::makeDirectory($viewsPath, 0755, true);
        }
        if (!File::exists($viewsPath . '/partials')) {
            File::makeDirectory($viewsPath . '/partials', 0755, true);
        }

        File::put($viewsPath . '/index.blade.php', $this->indexView($name, $table, $fields));
        File::put($viewsPath . '/create.blade.php', $this->createView($name, $table));
        File::put($viewsPath . '/edit.blade.php', $this->editView($name, $table));
        File::put($viewsPath . '/show.blade.php', $this->showView($name, $table, $fields));
        File::put($viewsPath . '/partials/form.blade.php', $this->formView($name, $table, $fields));
    }

    protected function indexView($name, $table, $fields)
    {
        $title = Str::headline(Str::plural($name));

        $columns = array_slice($fields, 0, 3);

        $thead = "";
        foreach ($columns as $col) {
            $thead .= "<th>" . Str::headline($col['name']) . "</th>\n                        ";
        }

        $tbody = "";
        foreach ($columns as $col) {
            $tbody .= "<td>{{ \$item->{$col['name']} }}</td>\n                        ";
        }

        return <<<BLADE
@extends('adminlte::page')

@section('title', '$title')

@section('content_header')
    <h1>$title</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{ route('$table.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
        </div>
        <div class="card-body table-responsive">
            <table id="crudTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="60">ID</th>
                        {$thead}<th width="150">Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse(\${$table} as \$item)
                    <tr>
                        <td>{{ \$item->lembaga_id }}</td>
                        {$tbody}<td>
                            <a href="{{ route('$table.show', \$item) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('$table.edit', \$item) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                            <form action="{{ route('$table.destroy', \$item) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">No data</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ \${$table}->links() }}
        </div>
    </div>
@stop

@section('js')
    <script>
        \$(function () {
            \$('#crudTable').DataTable({
                "paging": false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "ordering":  true,
                "info": false,
                "searching": true
            });
        });
    </script>
@stop
BLADE;
    }

    protected function createView($name, $table)
    {
        $title = "Create " . Str::headline($name);
        return <<<BLADE
@extends('adminlte::page')

@section('title', '$title')

@section('content_header')
    <h1>$title</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('$table.store') }}" method="POST">
                @csrf
                @include('$table.partials.form')
                <button class="btn btn-primary">Save</button>
                <a href="{{ route('$table.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@stop
BLADE;
    }

    protected function editView($name, $table)
    {
        $modelVar = Str::camel($name);
        $title = "Edit " . Str::headline($name);
        return <<<BLADE
@extends('adminlte::page')

@section('title', '$title')

@section('content_header')
    <h1>$title</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('$table.update', \${$modelVar}) }}" method="POST">
                @csrf
                @method('PUT')
                @include('$table.partials.form')
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('$table.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@stop
BLADE;
    }

    protected function showView($name, $table, $fields)
    {
        $modelVar = Str::camel($name);

        $rows = "";
        foreach ($fields as $field) {
            $label = Str::headline($field['name']);
            $rows .= "<p><strong>{$label}:</strong> {{ \${$modelVar}->{$field['name']} }}</p>\n            ";
        }

        $title = "Detail " . Str::headline($name);
        return <<<BLADE
@extends('adminlte::page')

@section('title', '$title')

@section('content_header')
    <h1>$title</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ \${$modelVar}->lembaga_id }}</p>
            {$rows}
            <p><strong>Created:</strong> {{ \${$modelVar}->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Updated:</strong> {{ \${$modelVar}->updated_at->format('d/m/Y H:i') }}</p>
            <a href="{{ route('$table.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@stop
BLADE;
    }

    protected function formView($name, $table, $fields)
    {
        $modelVar = Str::camel($name);

        $inputs = "";
        foreach ($fields as $field) {
            $inputs .= $this->fieldToFormInput($field, $modelVar) . "\n\n";
        }

        return $inputs;
    }

    protected function fieldToFormInput($field, $modelVar)
{
    $name = $field['name'];
    $type = $field['type'];
    $label = Str::headline($name);
    $nullable = $field['nullable'];
    $length = $field['length'] ?? null;

    $maxlengthAttr = $length ? "maxlength=\"{$length}\"" : "";

    return match ($type) {
        'text' => <<<BLADE
<div class="form-group mb-3">
    <label for="$name">$label</label>
    <textarea name="$name" id="$name" rows="4"
              class="form-control @error('$name') is-invalid @enderror">{{ old('$name', \${$modelVar}->$name ?? '') }}</textarea>
    @error('$name') <div class="invalid-feedback">{{ \$message }}</div> @enderror
</div>
BLADE,
        'integer', 'decimal' => <<<BLADE
<div class="form-group mb-3">
    <label for="$name">$label</label>
    <input type="number" name="$name" id="$name"
           class="form-control @error('$name') is-invalid @enderror"
           value="{{ old('$name', \${$modelVar}->$name ?? '') }}">
    @error('$name') <div class="invalid-feedback">{{ \$message }}</div> @enderror
</div>
BLADE,
        default => <<<BLADE
<div class="form-group mb-3">
    <label for="$name">$label</label>
    <input type="text" name="$name" id="$name"
           class="form-control @error('$name') is-invalid @enderror"
           value="{{ old('$name', \${$modelVar}->$name ?? '') }}"
           $maxlengthAttr>
    @error('$name') <div class="invalid-feedback">{{ \$message }}</div> @enderror
</div>
BLADE,
    };
}

    protected function appendRoute($name, $table)
    {
        $routePath = base_path('routes/web.php');
        $route = "Route::resource('{$table}', \\App\\Http\\Controllers\\{$name}Controller::class);\n";
        File::append($routePath, $route);
    }
}