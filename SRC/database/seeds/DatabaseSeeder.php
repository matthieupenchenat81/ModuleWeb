<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
	}

}

class UserTableSeeder extends Seeder {
 
	public function run()
	{
	// Uncomment the below to wipe the table clean before populating
		//DB::table('users')->truncate();

		$user = array(
		'firstname' => 'superadmin',
		'lastname' => 'superadmin',
		'school' => 'Montauban',
		'email' => 'superAdmin@superAdmin.com',
		'password' => Hash::make('superadmin'),
		'image' => 'pictures/user_picture/default.png',
		'droits' => '2'
		);
		 
		// Uncomment the below to run the seeder
		DB::table('users')->insert($user);
	 
		$user = array(
		'firstname' => 'admin',
		'lastname' => 'admin',
		'school' => 'Montauban',
		'email' => 'admin@admin.com',
		'password' => Hash::make('admin'),
		'image' => 'pictures/user_picture/default.png',
		'droits' => '1'
		);
		 
		// Uncomment the below to run the seeder
		DB::table('users')->insert($user);

		$user = array(
		'lastname' => 'ref',
		'firstname' => 'ref',
		'school' => 'Toulouse',
		'email' => 'ref@ref.com',
		'password' => Hash::make('ref'),
		'image' => 'pictures/user_picture/default.png',
		'droits' => '0'
		);
		 
		// Uncomment the below to run the seeder
		DB::table('users')->insert($user);
	}
}

