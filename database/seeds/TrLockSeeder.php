<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TrLockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('tr_lock')->insert([
            'tr_yoyaku' => 0,
            'tr_yoyaku_danjiki_jikan' => 0
        ]);


    }
}
