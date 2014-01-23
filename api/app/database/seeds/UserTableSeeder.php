<?php

class UserTableSeeder extends Seeder {
	public function run() {
		DB::table('users')->delete();

		User::create(array(
			'fullname' => "Christian Morgan Andersen",
			"email" => "cmandersen@outlook.com",
			"username" => "cmandersen",
			"password" => Hash::make("tmnt256")
		));
	}
}