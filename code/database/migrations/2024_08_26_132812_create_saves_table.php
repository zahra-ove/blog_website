<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('savedposts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('items')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->index('user_id', 'save_user_indx');
            $table->foreign('user_id', 'save_user_fk')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saves');
    }
};
