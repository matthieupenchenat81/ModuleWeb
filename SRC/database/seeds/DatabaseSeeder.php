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
		'name' => 'lolman',
		'email' => 'quentin.rouland@laposte.net',
		'password' => Hash::make('admin'),
		'image' => ''
		);
		 
		// Uncomment the below to run the seeder
		DB::table('users')->insert($user);
	}
}

