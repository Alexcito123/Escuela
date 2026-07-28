<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GradeSeeder::class,
        ]);

        if (!User::where('email', 'admin@escuela.test')->exists()) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@escuela.test',
            ]);
        }

        $this->call([
            FolderSeeder::class,
        ]);
    }
}
