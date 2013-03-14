<?php

class QuestionsTableSeeder extends Seeder {

	public function run()
	{
		$questions = array(
        [
            'user_id' => 1,
            'question' => 'Does this work?',
            'solved' => 0,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],
        [
            'user_id' => 1,
            'question' => 'Does it work for solved items?',
            'solved' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],
        [
            'user_id' => 2,
            'question' => 'Do questions from other users work?',
            'solved' => 0,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],
        [
            'user_id' => 3,
            'question' => 'How many questions shall I ask?',
            'solved' => 0,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],
        [
            'user_id' => 2,
            'question' => 'Do questions work out of order?',
            'solved' => 0,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],
        [
            'user_id' => 2,
            'question' => 'Does a solved question show up?',
            'solved' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],
		);

		DB::table('questions')->insert($questions);
	}

}
