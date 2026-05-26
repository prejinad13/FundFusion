<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            //Personal Info
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('sex')->nullable();
            $table->string('dob')->nullable();
            $table->longText('image')->nullable();
            //Family Info
            $table->string('father_name')->nullable();
            $table->string('grand_father_name')->nullable();
            //Permanent Address Info
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('municipality')->nullable();
            $table->string('locality')->nullable();
            $table->string('ward')->nullable();
            //Temporary Address Info
            $table->string('temporary_province')->nullable();
            $table->string('temporary_district')->nullable();
            $table->string('temporary_municipality')->nullable();
            $table->string('temporary_locality')->nullable();
            $table->string('temporary_ward')->nullable();
            //Citizenship Info
            $table->string('citizenship_number')->nullable();
            $table->string('citizenship_issue_date')->nullable();
            $table->string('citizenship_issue_district')->nullable();
            $table->longText('citizenship_front_document')->nullable();
            $table->longText('citizenship_back_document')->nullable();
            //Company Info
            $table->string('company_address')->nullable();
            $table->string('company_registration_date')->nullable();
            $table->string('company_registration_number')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('company_registration_certificate')->nullable();
            $table->string('company_pan_certificate')->nullable();
            //Other
            $table->enum('account_type',['individual','company'])->default('individual');
            $table->enum('kyc_status',['verified','rejected','processing','unverified'])->default('unverified');
            $table->longText('kyc_remarks')->nullable();
            $table->longText('description')->nullable();
            $table->string('max_investment_amount')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
