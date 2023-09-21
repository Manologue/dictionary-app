<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transwords', function (Blueprint $table) {
            $table->id();
            $table->string('word')->unique();
            $table->string('class')->nullable();
            $table->string('vocal')->nullable();
            $table->text('etymology')->nullable();
            $table->text('sample')->nullable();
            $table->boolean('active')->default(true);
            // $table->foreignIdFor(\App\Models\User::class, 'user_id')->nullable();
            $table->foreignId('keyword_id')->references('id')->on('keywords')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transwords');
    }
};