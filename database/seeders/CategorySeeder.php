<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(
            [
                'name'=>'Teknologi informasi',
                'slug'=>'teknologi-informasi',

            ]);
        Category::create(
            [
                'name'=>'Fiksi',
                'slug'=>'fiksi',

            ]);
        Category::create(
            [
                'name'=>'Non Fiktif',
                'slug'=>'non-fiktif',

            ]);
        Category::create(
            [
                'name'=>'Novel',
                'slug'=>'novel',
            ],);
    }
}
