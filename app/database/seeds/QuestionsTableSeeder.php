<?php

class QuestionsTableSeeder extends Seeder 
{

	public function run()
    {
        $data = array(
                //Q, Usr, solved, question
            array(1, 1, 0, 'Does this work?'),
            array(2, 1, 1, 'Does it work for solved items?'),
            array(3, 2, 0, 'Do questions from other users work?'),
            array(4, 3, 0, 'How many questions shall I ask?'),
            array(5, 2, 0, 'Do questions work out of order?'),
            array(6, 2, 1, 'Does a solved question show up?'),
        );

        $items = array();
        foreach($data as $item) {
            $items[] = array(
                'id'         => $item[0],
                'user_id'    => $item[1],
                'solved'     => $item[2],
                'question'   => $item[3],
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            );
        }

        DB::table('questions')->insert($items);
	}

}
