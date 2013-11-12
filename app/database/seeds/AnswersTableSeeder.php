<?php

class AnswersTableSeeder extends Seeder 
{

	public function run()
	{
        $data = array(
                //A, Usr, Q, answer
            array(1, 2, 1, 'Yes, it does!'),
            array(2, 1, 4, 'As many as you\'d like'),
        );

        $items = array();
        foreach($data as $item) {
            $items[] = array(
                'id'          => $item[0],
                'user_id'     => $item[1],
                'question_id' => $item[2],
                'answer'      => $item[3],
                'created_at'  => new DateTime,
                'updated_at'  => new DateTime,
            );
        }

		DB::table('answers')->insert($items);
	}

}
