<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->unique();
            $table->timestamps();
        });

        Schema::create('post_tags', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('post_id');
            $table->unsignedInteger('tag_id');

            $table->index('post_id', 'posttag_post_indx');
            $table->index('tag_id', 'posttag_tag_indx');

            $table->foreign('post_id', 'posttag_post_fk')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tag_id', 'posttag_tag_fk')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('post_tags');
    }
};
