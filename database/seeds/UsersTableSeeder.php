<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing records to start with a clean slate
        DB::table('users')->truncate();

        // Insert dummy user data
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'role'=>'admin',
                'password' => Hash::make('admin123'),
            ],
            [
                'name' => 'hasan',
                'email' => 'hasan@gmail.com',
                'role'=>'staff',
                'password' => Hash::make('hasan123'),
            ],
            // Add more dummy users as needed
        ]);
    }
}
