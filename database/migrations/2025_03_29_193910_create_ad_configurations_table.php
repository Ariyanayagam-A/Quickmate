<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ad_configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('org_id')->constrained('organizations')->onDelete('cascade');
            $table->string('host');
            $table->integer('port');
            $table->string('username');
            $table->string('password'); // Consider encrypting this field
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ad_configurations');
    }
};
