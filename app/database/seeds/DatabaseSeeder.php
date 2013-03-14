<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call('UsersTableSeeder');
		$this->call('QuestionsTableSeeder');
		$this->call('AnswersTableSeeder');
	}

}