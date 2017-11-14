<?php

use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 900; $i++) {
        	$post = \App\Post::inRandomOrder()->first();
        	$tagId = \App\Tag::inRandomOrder()->select('id')->first();
			$post->tags()->attach($tagId);
        }
    }
}
