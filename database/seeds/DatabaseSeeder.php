<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(SlidersTableSeeder::class);
         $this->call(PostsTableSeeder::class);
         $this->call(PostCategorySeeder::class);
         $this->call(TagsTableSeeder::class);
         $this->call(PostTagsTableSeeder::class);
         $this->call(PostViewsTableSeeder::class);
    }
}
