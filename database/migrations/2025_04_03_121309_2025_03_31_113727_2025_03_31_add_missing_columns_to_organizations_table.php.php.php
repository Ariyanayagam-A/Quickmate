<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('organizations', function (Blueprint $table) {
            $table->string('realm', 50)->nullable()->after('id');
            $table->string('password', 255)->nullable()->after('token');
        });
    }

    public function down() {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn(['realm', 'password']);
        });
    }
};
