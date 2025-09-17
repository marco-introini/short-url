<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('urls', function (Blueprint $table) {
            $table->string('name')->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('urls', function (Blueprint $table) {
            $table->removeColumn('name');
        });
    }
};
