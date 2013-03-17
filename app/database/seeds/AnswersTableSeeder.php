<?php

class AnswersTableSeeder extends Seeder {

	public function run()
	{
		$answers = array(
            array(
                'user_id' => 2,
                'question_id' => 1,
                'answer' => 'Yes, it does!',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'user_id' => 1,
                'question_id' => 4,
                'answer' => 'As many as you\'d like',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),

		);

		DB::table('answers')->insert($answers);
	}

}
