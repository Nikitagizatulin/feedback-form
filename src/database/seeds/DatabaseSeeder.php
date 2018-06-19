<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            [
                'name' => 'Manager',
                'email' => 'nikitagizatulin@gmail.com',
                'password' => Hash::make('123456'),
                'user_role' => 'manager'
            ]
        ]);
    }
}
