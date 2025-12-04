<?php

namespace Database\Seeders;

use App\Models\Warga;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CreateWargaDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        foreach (range(1, 100) as $index) {
            Warga::create([
                'no_ktp' => (string) $faker->unique()->numerify(str_repeat('#', 16)),
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']),
                'pekerjaan' => $faker->jobTitle,
                'telp' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
            ]);
        }
    }
}





