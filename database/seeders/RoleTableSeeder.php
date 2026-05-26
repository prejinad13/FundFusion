<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'superadmin',
                'guard_name' => 'web'
            ],
            [
                'name' => 'investor',
                'guard_name' => 'web'
            ],
            [
                'name' => 'investee',
                'guard_name' => 'web'
            ],
        ]);
    }
}
