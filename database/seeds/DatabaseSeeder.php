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
        // Don't run all, let's run in turn.
        $this->call([
            CategoryTableSeeder::class,
            // Before running TopicTableSeeder let's change category id in TopicTableSeeder.
            TopicTableSeeder::class,
            UserTableSeeder::class,
            PostTableSeeder::class,
            TagTableSeeder::class,
            PostTagTableSeeder::class,
            CommentTableSeeder::class
        ]);
    }
}
