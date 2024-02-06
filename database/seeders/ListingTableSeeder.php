<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ListingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=>'htin kyaw',
            'email'=>'htinkyaw@gmail.com',
            'password'=>bcrypt('12345678')
        ]);

        DB::table('users')->insert([
            'name'=>'chucky billy',
            'email'=>'chucky@gmail.com',
            'password'=>bcrypt('12345678')
        ]);

        \App\Models\Listing::factory(20)->create();
    }
}
