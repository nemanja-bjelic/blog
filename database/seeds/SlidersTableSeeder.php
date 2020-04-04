<?php

use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sliders')->truncate();
        
        $faker = \Faker\Factory::create();
        
        for($i=1; $i < 4; $i++) {
            
            \DB::table('sliders')->insert([
            'title' => $faker->sentence($nbWords = 5, $variableNbWords = true),
            'button_url' => $faker->url,
            'button_title' => $faker->company,
            'status' => '1',
            'priority' => $i,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
            
        }
        
    }
}
