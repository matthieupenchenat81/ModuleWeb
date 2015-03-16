<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigJeusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('config_jeus', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nom');            
            $table->string('parametres');            
            $table->string('referent_id');            
            $table->string('actifMemo');            
            $table->string('actifPuzzle');            
			$table->timestamps();
		});
        
        Schema::create('config_jeu_oeuvre', function(Blueprint $table)
		{
			$table->integer('config_jeu_id');
            $table->integer('oeuvre_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('config_jeu_oeuvre');
		Schema::drop('config_jeus');
	}

}
