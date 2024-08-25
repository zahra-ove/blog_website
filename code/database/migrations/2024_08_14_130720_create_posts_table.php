<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique()->nullable();
            $table->text('body')->nullable();
            $table->boolean('publish')->default(false)->comment('this post should be publish or not');
            $table->enum('status', ['pending', 'confirmed', 'rejected'])->default('pending')->comment('defines status of post. is it confirmed by admin or rejected or is in pending status');

            $table->unsignedBigInteger('author_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();

            $table->index('author_id', 'post_user_indx');
            $table->index('category_id', 'post_category_indx');

            $table->foreign('author_id', 'post_user_fk')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('category_id', 'post_category_fk')->references('id')->on('categories')->onDelete('set null')->onUpdate('cascade');

            $table->timestamp('publish_at')->nullable()->comment('for scheduling post publish');
            $table->timestamp('published_at')->nullable()->comment('post is published in which datatime');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
