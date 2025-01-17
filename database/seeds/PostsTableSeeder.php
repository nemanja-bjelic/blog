<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('posts')->truncate();
        
        $faker = \Faker\Factory::create();
        
        for($i = 0; $i < 20; $i++){
            \DB::table('posts')->insert([
            'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
            'description' => $faker->sentence($nbWords = 36, $variableNbWords = true),
            'content' => $faker->paragraph($nbSentences = 6, $variableNbSentences = true),
            'post_category_id' => rand(1, 6),
            'user_id' => rand(1, 3),
            'created_at' => $faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Belgrade'),
            'updated_at' => $faker->dateTimeThisMonth($max = 'now', $timezone = 'Europe/Belgrade')
            ]);
        }
    }
}
