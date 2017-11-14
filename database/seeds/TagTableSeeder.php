<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 182; $i++) {
        	$name = $faker->unique()->word;;
            $timestamps = Carbon\Carbon::now();

        	$tags[] = [
        		'id' => $faker->uuid,
        		'name' => $name,
        		'slug' => str_slug($name),
        		'created_at' => $timestamps,
        		'updated_at' => $timestamps
        	];
        }

        App\Tag::insert($tags);
    }
}
