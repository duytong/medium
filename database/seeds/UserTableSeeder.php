<?php

use App\User;
use Goutte\Client;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
            $users = $crawler->filter('.postMetaInline-authorLockup a')->each(function ($node) {
                return $node->attr('href');
            });
            $password = bcrypt('password');

            foreach ($users as $user) {
                $client  = new Client();
                $crawler = $client->request('GET', $user);
                $name = $crawler->filter('h1')->each(function ($node) {
                    return $node->text();
                });
                $summary = $crawler->filter('.hero-description')->each(function ($node) {
                    return $node->text();
                });
                $avatar = $crawler->filter('.avatar img')->each(function ($node) {
                    return $node->attr('src');
                });
                $array = array($name, $summary, $avatar);
                $key = array_column($array, 0);

                if (User::where('name', $key[0])->first()) {
                    break;
                }

                if (!empty($key[2])) {
                    $file = file_get_contents($key[2]);
                    $extension = pathinfo($key[2], PATHINFO_EXTENSION);
                    $fileName = time() . '_' . str_random(9) . '.' . $extension;
                    $location = public_path('storage/users/') . $fileName;
                    \Image::make($file)->resize(100, 100)->save($location);
                } else {
                    break;
                }

                $users = array();
                $faker = Faker::create();
                $timestamps = Carbon\Carbon::now();
                $slugName = text_limit($key[0], 2);

                $users [] = [
					'id'         => $faker->uuid,
					'name'       => $key[0],
					'username'   => str_slug($slugName, ''),
					'email'      => str_slug($slugName, '') . '@gmail.com',
					'summary'    => $key[1],
					'avatar'     => $fileName,
					'password'   => $password,
					'created_at' => $timestamps,
					'updated_at' => $timestamps
                ];
                
                User::insert($users);
            }
        }
    }
}
