<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOeuvresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('oeuvres', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('designation');
			$table->integer('technique_id');
			$table->integer('domaine_id');
			$table->integer('matiere_id');
			$table->integer('auteur_id');
            $table->string('image');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('oeuvres');
	}

}