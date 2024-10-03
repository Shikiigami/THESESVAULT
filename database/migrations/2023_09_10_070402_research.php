<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('research', function (Blueprint $table) {
            $table->id();
            $table->string('callno');
            $table->string('filename')->unique();
            $table->string('author');
            $table->enum('program', ['BS Information Technology', 'BS Computer Science', 'BS Civil Engineering', 'BS Accountancy']);
            $table->date('date_published');
            $table->foreign('college')->references('id')->on('college');
            $table->string('adviser');
            $table->enum('fieldname', ['Business', 'Technology', 'Education']);
            $table->timestamps();

            $table->unsignedBigInteger('parent_id')->nullable(); // Assuming parent_id can be nullable
            $table->foreign('parent_id')->references('id')->on('parents')->onDelete('cascade'); // Foreign key constraint
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('research');
    } 
};
