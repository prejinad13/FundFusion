<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleTableSeeder::class,
            SectorTableSeeder::class,
            UserTableSeeder::class,
            IndividualInvestorSeeder::class,
            IndividualInvesteeSeeder::class,
            CompanyInvestorSeeder::class,
            CompanyInvesteeSeeder::class,
            IdeaSeeder::class,
        ]);
    }
}
