<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
        * If empty the database, let's run it. Don't run all, let's run in turn.
        */
        $this->call(CategoryTableSeeder::class);
        // Before running this line, let's change id in TopicTableSeeder.
        $this->call(TopicTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(PostTableSeeder::class);
        
        /**
         * Create comments.
         */
        $this->call(CommentTableSeeder::class);

        /**
         * Create tags and attach tags for posts.
         */
        $this->call(TagTableSeeder::class);
        $this->call(PostTagTableSeeder::class);
    }
}
