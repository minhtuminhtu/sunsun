<?php

use Illuminate\Database\Seeder;

class MsUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('ms_user')->insert([
            'username' => "Admin",
            'tel' => '(555)-555-5555',
            'email' => "admin@gmail.com",
            'gender' => 'female',
            'birth_year' => '2020',
            'password' => bcrypt('pass'),
            'user_type' => config('const.auth.permission.ADMIN')
        ]);


    }
}
