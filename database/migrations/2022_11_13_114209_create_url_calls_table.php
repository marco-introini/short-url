<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Url;

return new class extends Migration {
    public function up()
    {
        Schema::create('url_calls', function (Blueprint $table) {
            $table->id();

            $table->string('ip_address')->nullable();

            $table->foreignIdFor(Url::class);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('url_calls');
    }
};