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
        Schema::create('historys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->string('action');
            $table->string('action_category');
            $table->string('user');
            $table->unsignedBigInteger('item_id')->nullable();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('set null');
            $table->text('description')->nullable();
            $table->json('before_change')->nullable();
            $table->json('after_change')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historys');
    }
};
