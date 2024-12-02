<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('rekrutmen', function (Blueprint $table) {
            $table->string('linked_url')->nullable()->after('jenis_kerja');
            $table->string('jobstreet_url')->nullable()->after('linked_url');
            $table->string('glint_url')->nullable()->after('jobstreet_url');
        });
    }
    
    public function down()
    {
        Schema::table('rekrutmen', function (Blueprint $table) {
            $table->dropColumn(['linked_url', 'jobstreet_url', 'glint_url']);
        });
    }
};
