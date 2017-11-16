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
        	$tagId = \App\Tag::inRandomOrder()->value('id');

            $countPostId = DB::table('post_tag')->where('post_id', $post->id)->count();

            if ($countPostId < 6) {
                $post->tags()->attach($tagId);
            }
        }
    }
}
