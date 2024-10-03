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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('research_id');
            $table->string('purpose');
            $table->enum('receiving_method', ['Through Email', 'In Person']);
            $table->enum('status', ['Pending', 'Approved', 'Declined'])->default('Pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('research_id')->references('id')->on('research');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests'); 
    }
};
