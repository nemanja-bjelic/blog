<?php

use Illuminate\Database\Seeder;

class PostTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_tags')->truncate();
        
        $tagIds = \DB::table('tags')->get()->pluck('id');
        
        $postIds = \DB::table('posts')->get()->pluck('id');
        
        foreach($postIds as $postId){
            $randomTagIds = $tagIds->random(rand(1, 3));
            
            foreach($randomTagIds as $tagId){
                \DB::table('post_tags')->insert([
                    'post_id' => $postId,
                    'tag_id' => $tagId,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
    }
}
