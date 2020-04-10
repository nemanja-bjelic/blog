<?php

use Illuminate\Database\Seeder;

class PostViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = \Faker\Factory::create();
        
        \DB::table('post_views')->truncate();
        
        $numberOfPosts = \DB::table('posts')->count();
        
        for($i = 0; $i < $numberOfPosts; $i++){
            \DB::table('post_views')->insert([
            'post_id' => $i + 1,
            'created_at' => $faker->dateTimeThisMonth($max = 'now', $timezone = 'Europe/Belgrade'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        }
        
        
    }
}
