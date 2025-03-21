<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->timestamp('assigned_at')->nullable()->after('priority'); // Adds assigned_at column
        });
    }

    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('assigned_at');
        });
    }
};
