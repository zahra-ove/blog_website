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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('body');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('post_id')->nullable();

            $table->index('user_id', 'comment_user_indx');
            $table->index('post_id', 'comment_post_indx');

            $table->foreign('user_id', 'comment_user_fk')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('post_id', 'comment_post_fk')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');

            $table->enum('confirmed', ['pending', 'confirmed', 'rejected'])->default('pending');
            $table->unsignedBigInteger('comment_id')->nullable();

            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
