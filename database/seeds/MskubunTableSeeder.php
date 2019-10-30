<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MskubunTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        DB::query(
            '
                INSERT INTO ms_kubun (kubun_type,kubun_id,kubun_value,sort_no)
                VALUES
                       ()
            '
        );

    }
}
