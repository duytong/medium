<?php

use App\Post;
use Goutte\Client;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
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

        foreach ($topics as $topic) {
            $client = new Client();
            $crawler = $client->request('GET', $topic);
            $posts = $crawler->filter('div.u-flex0.u-sizeFullWidth a')->each(function ($node) {
                return $node->attr('href');
            });

            foreach ($posts as $post) {
                $client  = new Client();
                $crawler = $client->request('GET', $post);
                $title = $crawler->filter('.section-inner h1')->each(function ($node) {
                    return $node->text();
                });
                $body = $crawler->filter('.section-inner p')->each(function ($node) {
                    return $node->text();
                });
                $image = $crawler->filter('.section-inner img')->each(function ($node) {
                    return $node->attr('src');
                });

                $array = array($title, $image);
                $key = array_column($array, 0);
                $textTitle = $key[0];

                $arrayBody = array();
                foreach ($body as $value) {
                    $arrayBody [] = '<p>'.$value.'</p>';
                }
                $textBody = implode('', $arrayBody);

                if (empty($textTitle) || empty($textBody) || Post::where('title', '=', $textTitle)->first() || empty($key[1])) {
                    break;
                } else {
                    $file = file_get_contents($key[1]);
                    if (pathinfo($key[1], PATHINFO_EXTENSION)) {
                        $extension = pathinfo($key[1], PATHINFO_EXTENSION);
                    } else {
                        $extension = 'jpg';
                    }
                    $fileName = time() . '_' . str_random(9) . '.' . $extension;
                    File::put(public_path('storage/posts/') . $fileName, $file);               
                }

                $posts = array();
                $faker = Faker::create();
                $timestamps = Carbon\Carbon::now();
                $userId = \App\User::inRandomOrder()->select('id')->first();
                $topicId = \App\Topic::inRandomOrder()->select('id')->first();

                $posts [] = [
                    'id'         => $faker->uuid,
                    'user_id'    => $userId['id'],
                    'topic_id'   => $topicId['id'],
                    'title'      => $textTitle,
                    'slug'       => str_slug($textTitle),
                    'body'       => $textBody,
                    'image'      => $fileName,
                    'view'       => rand(1, 9000),
                    'created_at' => $timestamps,
                    'updated_at' => $timestamps
                ];
                
                Post::insert($posts);
            }
        }
    }
}
