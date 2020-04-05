<?php

use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('post_categories')->truncate();
        
        $faker = \Faker\Factory::create();
        
        for($i = 0; $i < 6; $i++){
            \DB::table('post_categories')->insert([
                'name' => $faker->city,
                'description' => $faker->realText(),
                'priority' => $i + 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
