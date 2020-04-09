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
        
        for($i = 1; $i < 15; $i++){
            \DB::table('post_views')->insert([
            'post_id' => rand(1, 6),
            'created_at' => $faker->dateTimeThisMonth($max = 'now', $timezone = 'Europe/Belgrade'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        }
        
        
    }
}
