<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->string('realm', 100)->after('id'); // Adjust 'id' if needed
            $table->string('uuid', 100)->after('realm')->unique()->default('uuid');
            $table->string('master_orgid', 100)->after('uuid');
        });
    }

    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn(['realm', 'uuid', 'quickmate_orgid']);
        });
    }
};
