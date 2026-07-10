<?php

namespace Database\Seeders;

use App\Models\Folder;
use App\Models\Grade;
use Illuminate\Database\Seeder;

class FolderSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            'Matemáticas',
            'Español',
            'Escritura',
            'Lectura',
            'Ciencias',
            'Historia',
            'Geografía',
            'Inglés',
        ];

        $grades = Grade::all();

        foreach ($grades as $grade) {
            foreach ($subjects as $subject) {
                Folder::create([
                    'grade_id' => $grade->id,
                    'name' => $subject,
                    'description' => "Carpeta de {$subject} para {$grade->name}",
                    'user_id' => 1,
                ]);
            }
        }
    }
}
