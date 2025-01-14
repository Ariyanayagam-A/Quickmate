<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', 
        
        function (Blueprint $table) {
            $table->id(); 
            $table->string('ticket_id')->unique();
            $table->string('subject');
            $table->bigInteger('raised_by')->index();
            $table->string('image')->nullable();
            $table->integer('category')->index(); 
            $table->string('summary'); 
            $table->tinyInteger('priority')->nullable();; 
            $table->bigInteger('assignee')->nullable();
            $table->string('feedback')->nullable();
            $table->tinyInteger('status'); 
            $table->timestamps(); 
            $table->timestamp('closed_at')->nullable(); 
            $table->timestamp('deleted_at')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
