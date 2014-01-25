<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('users')->truncate();

		User::create(array(
			'fullname' => "Christian Morgan Andersen",
			"email" => "cmandersen@outlook.com",
			"username" => "cmandersen",
			"password" => Hash::make("tmnt256")
		));
	}

}
