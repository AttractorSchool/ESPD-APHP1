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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('date');
            $table->time('time')->nullable();
            $table->string('location');
            $table->enum('format', ['online', 'offline']);
            $table->decimal('price');
            $table->string('picture')->nullable();
            $table->foreignId('city_id')->nullable()->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('author_id')->default(1);
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
