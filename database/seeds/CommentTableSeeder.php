<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 900; $i++) {
            $userId = \App\User::inRandomOrder()->value('id');
            $postId = \App\Post::inRandomOrder()->value('id');
            $timestamps = Carbon\Carbon::now();

        	$comments[] = [
        		'id' => $faker->uuid,
        		'user_id' => $userId,
				'post_id' => $postId,
        		'body' => $faker->paragraph,
        		'created_at' => $timestamps,
        		'updated_at' => $timestamps
        	];
        }

        App\Comment::insert($comments);
    }
}
