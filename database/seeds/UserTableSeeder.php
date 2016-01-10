<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
	    DB::table('users')->delete();
	    User::create(array(
	        'name'     => 'Pepe Pompin',
	        'email'    => 'merkuriospam@gmail.com',
	        'password' => Hash::make('Ch4nch4s2'),
	    ));
	}

}