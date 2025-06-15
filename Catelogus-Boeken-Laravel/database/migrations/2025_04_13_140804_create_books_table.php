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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('shelf_number');
            $table->enum('cover_type', ['hardcover', 'softcover']);
            $table->integer('pages');
            $table->enum('language', ['arabic', 'dutch', 'english', 'other']);
            $table->year('publication_year')->nullable();
            $table->string('publisher'); // Uitgever/drukkerij als gewoon veld
            $table->integer('stock')->default(0);
            $table->boolean('is_available')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
