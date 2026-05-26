<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sectors')->insert([
            [
                'name'=> 'Information Technology',
                'slug' => Str::slug('Information Technology'),
                'icon' =>'fa-solid fa-computer',
            ],
            [
                'name'=> 'Education',
                'slug' => Str::slug('Education'),
                'icon' =>'fa-solid fa-graduation-cap',
            ],
            [
                'name'=> 'Health',
                'slug' => Str::slug('Health'),
                'icon' =>'fa-solid fa-heart-pulse',
            ],
            [
                'name'=> 'Agriculture',
                'slug' => Str::slug('Agriculture'),
                'icon' =>'fa-solid fa-wheat-awn',
            ],
            [
                'name'=> 'Energy',
                'slug' => Str::slug('Energy'),
                'icon' =>'fa-solid fa-atom',
            ],
            [
                'name'=> 'Telecommunication',
                'slug' => Str::slug('Telecommunication'),
                'icon' =>'fa-solid fa-tower-cell',
            ],
            [
                'name'=> 'Transportation',
                'slug' => Str::slug('Transportation'),
                'icon' =>'fa-solid fa-car',
            ],
            [
                'name'=> 'Entertainment',
                'slug' => Str::slug('Entertainment'),
                'icon' =>'fa-solid fa-masks-theater',
            ],
            [
                'name'=> 'Tourism',
                'slug' => Str::slug('Tourism'),
                'icon' =>'fa-regular fa-compass',
            ],
            [
                'name'=> 'Food & Bevarage',
                'slug' => Str::slug('Food & Beverage'),
                'icon' =>'fa-solid fa-utensils',
            ],
            [
                'name'=> 'Manufacturing',
                'slug' => Str::slug('Manufacturing'),
                'icon' =>'fa-solid fa-industry',
            ],
            [
                'name'=> 'Fashion',
                'slug' => Str::slug('Manufacturing'),
                'icon' =>'fa-solid fa-shirt',
            ],
            [
                'name'=> 'Automobile',
                'slug' => Str::slug('Automobile'),
                'icon' =>'fa-solid fa-gear',
            ],
        ]);
    }
}
