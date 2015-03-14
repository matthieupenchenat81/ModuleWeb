<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('referents', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('email');            
            $table->string('motdepasse');
            $table->string('nom');
            $table->string('prenom');
            $table->string('etablissement');
            $table->string('image');
            $table->string('remember_token',100)->nullable();
			$table->timestamps();
		});
        
        Schema::create('password_resets', function(Blueprint $table)
		{
            $table->string('email');            
            $table->string('token');
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
		Schema::drop('referents');
	}

}
