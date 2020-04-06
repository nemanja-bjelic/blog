<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->truncate();
        
        \DB::table('users')->insert([
            'name' => 'Nemanja Bjelic',
            'phone' => '+381641112223',
            'email' => 'nemanja.bjelic353@gmail.com',
            'password' => Hash::make('cubesphp'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        
        \DB::table('users')->insert([
            'name' => 'Petar Petrovic',
            'phone' => '+381641112223',
            'email' => 'petar.petrovic@cubes.rs',
            'password' => Hash::make('cubesphp'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        
        \DB::table('users')->insert([
            'name' => 'Aleksandar Dimic',
            'phone' => '+381641112223',
            'email' => 'aleksandar.dimic@cubes.rs',
            'password' => Hash::make('cubesphp'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
