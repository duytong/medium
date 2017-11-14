<?php

use Goutte\Client;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://medium.com/topics');
        $categories = $crawler->filter('header .heading-title')->each(function ($node) {
            return $node->text();
        });

        foreach ($categories as $category) {
            $categories = array();
            $faker = Faker::create();
            $timestamps = Carbon\Carbon::now();
            
            $categories [] = [
                'id'         => $faker->uuid,
                'name'       => $category,
                'created_at' => $timestamps,
                'updated_at' => $timestamps
            ];
            
            \App\Category::insert($categories);
        }
    }
}
