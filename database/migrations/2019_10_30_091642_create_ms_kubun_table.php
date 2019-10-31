<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsKubunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_kubun', function (Blueprint $table) {
            $table->string('kubun_type',3)->comment('primary key (kubun_type,kubun_id)');
            $table->string('kubun_id',2);
            $table->string('kubun_value',255);
            $table->integer('sort_no')->comment('orderBy');
            $table->string('notes',255)->nullable()->comment('value to use select');
            $table->primary(['kubun_type','kubun_id']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_kubun');
    }
}
