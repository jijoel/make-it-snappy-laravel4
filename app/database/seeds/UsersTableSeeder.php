<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
        $data = array(
            array(1, 'joel', 'test'),
            array(2, 'test1', 'test'),
            array(3, 'test2', 'test'),
		);

        $items = array();
        foreach($data as $item) {
            $items[] = array(
                'id'         => $item[0],
                'username'   => $item[1],
                'password'   => Hash::make($item[2]),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            );
        }

		DB::table('users')->insert($items);
	}

}
