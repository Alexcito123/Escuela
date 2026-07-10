<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        $grades = [
            ['name' => 'Tercero de Preescolar', 'level' => 'Preescolar', 'display_order' => 1],
            ['name' => 'Primero de Primaria',   'level' => 'Primaria',   'display_order' => 2],
            ['name' => 'Segundo de Primaria',   'level' => 'Primaria',   'display_order' => 3],
            ['name' => 'Tercero de Primaria',   'level' => 'Primaria',   'display_order' => 4],
            ['name' => 'Cuarto de Primaria',    'level' => 'Primaria',   'display_order' => 5],
            ['name' => 'Quinto de Primaria',    'level' => 'Primaria',   'display_order' => 6],
            ['name' => 'Sexto de Primaria',     'level' => 'Primaria',   'display_order' => 7],
        ];

        foreach ($grades as $grade) {
            Grade::create($grade);
        }
    }
}
