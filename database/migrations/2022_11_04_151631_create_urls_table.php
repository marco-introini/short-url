<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('urls', function (Blueprint $table) {
            $table->id();

            $table->string('short_url_string')->unique();
            $table->string('original_url');
            $table->foreignIdFor(User::class);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('urls');
    }
};