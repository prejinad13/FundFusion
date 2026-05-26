<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanyInvestorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            $investment_company1 = [
                'name' => 'WealthVenture Investments Ltd.',
                'email' => 'wealthventure@yopmail.com',
                'phone' => '9876543210',
                'image' => 'new-dashboard/img/profile_picture/wealthventure.jpg',
                'company_address' => 'Kathmandu-32, Baneshwor, Kathmandu',
                'company_registration_date' => '2010-07-15',
                'company_registration_number' => 'C12345678',
                'pan_number' => 'ABCDE1234F',
                'company_registration_certificate' => 'new-dashboard/img/company_registration.jpg',
                'company_pan_certificate' => 'new-dashboard/img/company_pan.png',
                'account_type' => 'company',
                'kyc_status' => 'processing',
                'kyc_remarks' => null,
                'description' => 'Leading investment firm specializing in diverse portfolios.',
                'max_investment_amount' => '500000',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at'=>Carbon::now()->subDays(rand(1, 30)),
            ],
            $investment_company2 = [
                'name' => 'CapitalHarbor Ventures Inc.',
                'email' => 'capitalharbor@yopmail.com',
                'phone' => '9988776655',
                'image' => 'new-dashboard/img/profile_picture/capitalharbor.jpg',
                'company_address' => 'Lalitpur-25, Jawalakhel, Lalitpur',
                'company_registration_date' => '2012-03-20',
                'company_registration_number' => 'C98765432',
                'pan_number' => 'XYZW9876A',
                'company_registration_certificate' => 'new-dashboard/img/company_registration.jpg',
                'company_pan_certificate' => 'new-dashboard/img/company_pan.png',
                'account_type' => 'company',
                'kyc_status' => 'verified',
                'kyc_remarks' => null,
                'description' => 'Strategic investment partner for growing businesses.',
                'max_investment_amount' => '750000',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at'=>Carbon::now()->subDays(rand(1, 30)),
            ],
            $investment_company3 = [
                'name' => 'ProInnova Capital Group Ltd.',
                'email' => 'proinnova@yopmail.com',
                'phone' => '9876123450',
                'image' => 'new-dashboard/img/profile_picture/proinnova.jpg',
                'company_address' => 'Kathmandu-15, Durbar Marg, Kathmandu',
                'company_registration_date' => '2015-11-10',
                'company_registration_number' => 'C56789012',
                'pan_number' => 'LMNO1234P',
                'company_registration_certificate' => 'new-dashboard/img/company_registration.jpg',
                'company_pan_certificate' => 'new-dashboard/img/company_pan.png',
                'account_type' => 'company',
                'kyc_status' => 'verified',
                'kyc_remarks' => null,
                'description' => 'Innovative investment solutions for sustainable growth.',
                'max_investment_amount' => '600000',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at'=>Carbon::now()->subDays(rand(1, 30)),
            ],
            $investment_company4 = [
                'name' => 'EagleEye Investments Inc.',
                'email' => 'eagleeye@yopmail.com',
                'phone' => '9765432109',
                'image' => 'new-dashboard/img/profile_picture/eagleeye.jpg',
                'company_address' => 'Kathmandu-10, Thamel, Kathmandu',
                'company_registration_date' => '2018-06-25',
                'company_registration_number' => 'C34567890',
                'pan_number' => 'PQRS5678K',
                'company_registration_certificate' => 'new-dashboard/img/company_registration.jpg',
                'company_pan_certificate' => 'new-dashboard/img/company_pan.png',
                'account_type' => 'company',
                'kyc_status' => 'verified',
                'kyc_remarks' => null,
                'description' => 'Focused on strategic investments with a global perspective.',
                'max_investment_amount' => '800000',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at'=>Carbon::now()->subDays(rand(1, 30)),
            ],
            $investment_company5 = [
                'name' => 'Stratosphere Capital Holdings Ltd.',
                'email' => 'stratospherecapital@yopmail.com',
                'phone' => '9658741023',
                'image' => 'new-dashboard/img/profile_picture/stratospherecapital.jpg',
                'company_address' => 'Kathmandu-22, Lakeside, Kathmandu',
                'company_registration_date' => '2013-09-30',
                'company_registration_number' => 'C23456789',
                'pan_number' => 'FGHI6789Q',
                'company_registration_certificate' => 'new-dashboard/img/company_registration.jpg',
                'company_pan_certificate' => 'new-dashboard/img/company_pan.png',
                'account_type' => 'company',
                'kyc_status' => 'rejected',
                'kyc_remarks' => 'Company Registration Certificate is unclear',
                'description' => 'Striving for excellence in investment management and advisory.',
                'max_investment_amount' => '700000',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at'=>Carbon::now()->subDays(rand(1, 30)),
            ],
        ]);
        $investment_company1 = User::find(22);
        $investment_company2 = User::find(23);
        $investment_company3 = User::find(24);
        $investment_company4 = User::find(25);
        $investment_company5 = User::find(26);

        //Assign Roles
        $investment_company1->assignRole('investor');
        $investment_company2->assignRole('investor');
        $investment_company3->assignRole('investor');
        $investment_company4->assignRole('investor');
        $investment_company5->assignRole('investor');

        //Sync Interests
        $investment_company1->sectors()->sync([3, 6, 9, 12]);
        $investment_company2->sectors()->sync([1, 5, 8, 11]);
        $investment_company3->sectors()->sync([2, 7, 10, 13]);
        $investment_company4->sectors()->sync([4, 6, 9, 12]);
        $investment_company5->sectors()->sync([2, 5, 8, 11]);

    }
}
