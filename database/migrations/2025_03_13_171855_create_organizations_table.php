<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('organization_name');
            $table->string('industry');
            $table->string('organization_type');
            $table->string('website_url')->nullable();
            $table->string('organization_size');
            $table->string('logo')->nullable();
            $table->string('official_email');
            $table->string('phone_number');
            $table->text('address');
            $table->string('admin_name');
            $table->string('admin_email');
            $table->string('admin_phone');
            $table->string('designation');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organizations');
    }
};
