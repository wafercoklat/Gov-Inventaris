<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => strtolower('Admin'),
            'username' => strtolower('admin'),
            'password' => Hash::make('admin123'),
        ]);
    }
}
