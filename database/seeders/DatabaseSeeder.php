<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(FormSeeder::class);
        $this->call(ElementSeeder::class);
        $this->call(FormElementSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(DistritoSeeder::class);
    }
}
