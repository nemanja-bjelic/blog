<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('photo')->nullable();
            $table->text('description');
            $table->longText('content');
            $table->boolean('status')->default(1)->comment('Show if column is enabled or desabled');
            $table->boolean('important')->default(1)->comment('Show if column is for index page or not');
            $table->bigInteger('post_category_id')->nullable();
            $table->bigInteger('user_id');
            $table->integer('visits_number')->nullable()->default(0);
            $table->integer('comments_number')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
