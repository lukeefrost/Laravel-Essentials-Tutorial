<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            if (env('DB_CONNECTION') === 'sqlite_testing') {
              $table->text('content')->default('');
            } else {
              $table->text('content');
            }

            $table->timestamps();

            //$table->integer('blog_post_id')->index();
            //$table->foreign('blog_post_id')->references('id')->on('blogposts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
