<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanyInvesteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            $investee_company1 = [
                'name' => 'InnovateTech Solutions Ltd.',
                'email' => 'innovatetech@yopmail.com',
                'phone' => '9876543210',
                'image' => 'new-dashboard/img/profile_picture/innovatetech.jpg',
                'company_address' => 'Kathmandu-10, Chabahil, Kathmandu',
                'company_registration_date' => '2014-08-18',
                'company_registration_number' => 'C45678901',
                'pan_number' => 'ABCD5678E',
                'company_registration_certificate' => 'new-dashboard/img/company_registration.jpg',
                'company_pan_certificate' => 'new-dashboard/img/company_pan.png',
                'account_type' => 'company',
                'kyc_status' => 'verified',
                'kyc_remarks' => null,
                'description' => 'Pioneering technology solutions for the modern world.',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at'=>Carbon::now()->subDays(rand(1, 30)),
            ],
            $investee_company2 = [
                'name' => 'GreenSolutions EcoTech Ltd.',
                'email' => 'greensolutions@yopmail.com',
                'phone' => '9988776655',
                'image' => 'new-dashboard/img/profile_picture/greensolutions.jpg',
                'company_address' => 'Kathmandu-15, Pulchowk, Lalitpur',
                'company_registration_date' => '2016-05-22',
                'company_registration_number' => 'C34567890',
                'pan_number' => 'WXYZ1234F',
                'company_registration_certificate' => 'new-dashboard/img/company_registration.jpg',
                'company_pan_certificate' => 'new-dashboard/img/company_pan.png',
                'account_type' => 'company',
                'kyc_status' => 'processing',
                'kyc_remarks' => null,
                'description' => 'Leaders in eco-friendly technology and sustainable solutions.',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at'=>Carbon::now()->subDays(rand(1, 30)),
            ],
            $investee_company3 = [
                'name' => 'HealthWave Pharmaceuticals Ltd.',
                'email' => 'healthwavepharma@yopmail.com',
                'phone' => '9876123450',
                'image' => 'new-dashboard/img/profile_picture/healthwavepharma.jpg',
                'company_address' => 'Kathmandu-5, Maharajgunj, Kathmandu',
                'company_registration_date' => '2017-12-10',
                'company_registration_number' => 'C56789012',
                'pan_number' => 'UVWX9876A',
                'company_registration_certificate' => 'new-dashboard/img/company_registration.jpg',
                'company_pan_certificate' => 'new-dashboard/img/company_pan.png',
                'account_type' => 'company',
                'kyc_status' => 'verified',
                'kyc_remarks' => null,
                'description' => 'Innovative pharmaceuticals for a healthier future.',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at'=>Carbon::now()->subDays(rand(1, 30)),
            ],
            $investee_company4 = [
                'name' => 'AgriTech Harvest Innovations Ltd.',
                'email' => 'agritechharvest@yopmail.com',
                'phone' => '9765432109',
                'image' => 'new-dashboard/img/profile_picture/agritechharvest.jpg',
                'company_address' => 'Kathmandu-3, Kalimati, Kathmandu',
                'company_registration_date' => '2019-04-30',
                'company_registration_number' => 'C23456789',
                'pan_number' => 'JKLM5678K',
                'company_registration_certificate' => 'new-dashboard/img/company_registration.jpg',
                'company_pan_certificate' => 'new-dashboard/img/company_pan.png',
                'account_type' => 'company',
                'kyc_status' => 'verified',
                'kyc_remarks' => null,
                'description' => 'Revolutionizing agriculture through advanced technology.',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at'=>Carbon::now()->subDays(rand(1, 30)),
            ],
            $investee_company5 = [
                'name' => 'SmartEdu Solutions Pvt. Ltd.',
                'email' => 'smartedu@yopmail.com',
                'phone' => '9658741023',
                'image' => 'new-dashboard/img/profile_picture/smartedu.jpg',
                'company_address' => 'Kathmandu-8, Baneshwor, Kathmandu',
                'company_registration_date' => '2015-11-15',
                'company_registration_number' => 'C78901234',
                'pan_number' => 'NOPQ6789Q',
                'company_registration_certificate' => 'new-dashboard/img/company_registration.jpg',
                'company_pan_certificate' => 'new-dashboard/img/company_pan.png',
                'account_type' => 'company',
                'kyc_status' => 'rejected',
                'kyc_remarks' => 'PAN Number does not match the document',
                'description' => 'Transforming education with smart and innovative solutions.',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at'=>Carbon::now()->subDays(rand(1, 30)),
            ],
    ]);
    $investee_company1 = User::find(27);
    $investee_company2 = User::find(28);
    $investee_company3 = User::find(29);
    $investee_company4 = User::find(30);
    $investee_company5 = User::find(31);

    //Assign Role
    $investee_company1->assignRole('investee');
    $investee_company2->assignRole('investee');
    $investee_company3->assignRole('investee');
    $investee_company4->assignRole('investee');
    $investee_company5->assignRole('investee');

    //Sync Interests
    $investee_company1->sectors()->sync([3, 7, 11, 13]);
    $investee_company2->sectors()->sync([2, 6, 9, 12]);
    $investee_company3->sectors()->sync([1, 5, 8, 10]);
    $investee_company4->sectors()->sync([4, 7, 11, 13]);
    $investee_company5->sectors()->sync([2, 5, 9, 12]);

    }
}
