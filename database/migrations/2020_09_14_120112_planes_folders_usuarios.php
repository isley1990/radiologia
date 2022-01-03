<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlanesFoldersUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create('planes', function (Blueprint $table) {
     $table->increments('id');
     $table->string('folder_id');
     $table->integer('user_id');
     $table->string('tipo_plan');
     $table->integer('cupos');
     $table->date('fecha_inicio');
     $table->date('fecha_final');
     $table->smallinteger('Estado');
	 $table->timestamps();

     



    
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
