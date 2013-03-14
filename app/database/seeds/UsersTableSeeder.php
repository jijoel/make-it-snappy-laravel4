<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$users = array(
        [
            'username' => 'joel',
            'password' => Hash::make('test'),
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],
        [
            'username' => 'test1',
            'password' => Hash::make('test'),
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],
        [
            'username' => 'test2',
            'password' => Hash::make('test'),
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],

		);

		DB::table('users')->insert($users);
	}

}
