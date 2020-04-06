<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('tags')->truncate();
        
        $faker = \Faker\Factory::create();
        
        for($i=1; $i < 10; $i++) {
            
            \DB::table('tags')->insert([
            'name' => $faker->word,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
            
        }
    }
}
