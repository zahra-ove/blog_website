<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body')->nullable();

            $table->unsignedBigInteger('author_id')->nullable(); // BIGINT UNSIGNED
            $table->unsignedInteger('category_id')->nullable(); // INT UNSIGNED

            $table->index('author_id', 'post_user_indx');
            $table->index('category_id', 'post_category_indx');

            $table->foreign('author_id', 'post_userid_fk')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('category_id', 'post_categoryid_fk')->references('id')->on('categories')->onDelete('set null')->onUpdate('cascade');

            $table->timestamp('publish_at')->nullable();
            $table->timestamp('published_at')->nullable();

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
