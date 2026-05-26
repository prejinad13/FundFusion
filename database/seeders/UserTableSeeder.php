<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'=> 'Superadmin',
                'email' =>'superadmin@fundfusion.com',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                'email_verified_at'=>Carbon::now(),
                'password' => bcrypt('password'),
            ],
        ]);

        $superadmin = User::find(1)->assignRole('superadmin');
    }
}
