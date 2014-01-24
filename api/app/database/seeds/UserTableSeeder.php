<?php

class UserTableSeeder extends Seeder {
	public function run() {
		DB::table('users')->delete();

		User::create(array(
			'fullname' => "XXX",
			"email" => "XXX@XXX.XXX",
			"username" => "XXX",
			"password" => Hash::make("xxx")
		));
	}
}
