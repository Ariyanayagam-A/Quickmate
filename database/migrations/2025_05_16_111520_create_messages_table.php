<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->unsignedBigInteger('ticket_id');
            $table->unsignedBigInteger('sender_id');    // user or engineer sending the message
            $table->unsignedBigInteger('receiver_id')->nullable(); // optional (for replies)

            // Content
            $table->text('message');

            $table->timestamps();

            // Relationships
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};

