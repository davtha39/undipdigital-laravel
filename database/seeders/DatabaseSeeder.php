<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        DB::table('users')->insert([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('admin1234'),
            'role'=>'admin'
        ]);
        DB::table('users')->insert([
            'name'=>'user',
            'email'=>'user@gmail.com',
            'password'=>Hash::make('user1234'),
            'role'=>'user'
        ]);
    }
}
