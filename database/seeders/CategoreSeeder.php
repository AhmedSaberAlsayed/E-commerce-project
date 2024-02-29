<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

        public function run(): void
        {
            Category::factory()
            ->count(5)
            ->hasProduct(100)
            ->create();

            Category::factory()
            ->count(3)
            ->hasProduct(50)
            ->create();

            Category::factory()
            ->count(2)
            ->hasProduct(30)
            ->create();



        }
    }
