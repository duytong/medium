<?php

use Goutte\Client;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
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
        $topics = $crawler->filter('.u-flexColumn.u-flex0 a:first-child')->each(function ($node) {
            return $node->attr('href');
        });

        foreach ($topics as $key => $topic) {
            $client = new Client();
            $crawler = $client->request('GET', $topic);
            $results = $crawler->filter('body')->each(function ($node) {
                return [
                    'name' => $node->filter('h1')->text(),
                    'overview' => $node->filter('.ui-body')->text()
                ];
            });

            // Change in here
            if ($key < 10) {
                $categoryId = 'b309ffba-b199-39de-a06f-bbea9a724ec5';
            } elseif ($key > 9 && $key < 17) {
                $categoryId = 'ab0eec6e-f27f-3e36-8a2a-a5ed0119f45f';
            } elseif ($key > 16 && $key < 30) {
                $categoryId = '490b463c-05f0-3b3a-9493-adbb2a7186bb';
            } elseif ($key > 29 && $key < 41) {
                $categoryId = 'd70e6c80-58d7-387e-8384-a8dde6d6272c';
            } elseif ($key > 40 && $key <= 50) {
                $categoryId = '7c2fbfbb-6c33-3f95-a412-fcc8ead8723b';
            }

            $keyName = array_column($results, 'name');
            $keyOverview = array_column($results, 'overview');
            $array = array($keyName, $keyOverview);
            $keyArray = array_column($array, 0);

            $textName = $keyArray[0];
            $textOverview = $keyArray[1];

            $topics = array();
            $faker = Faker::create();
            $timestamps = Carbon\Carbon::now();
            
            $topics [] = [
                'id'          => $faker->uuid,
                'category_id' => $categoryId,
                'name'        => $textName,
                'slug'        => str_slug($textName),
                'overview'    => $textOverview,
                'created_at'  => $timestamps,
                'updated_at'  => $timestamps
            ];
            
            \App\Topic::insert($topics);
        }
    }
}
