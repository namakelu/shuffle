<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pairing_histories', function (Blueprint $table) {
            $table->id();
            $table->json('pairing');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pairing_histories');
    }
};
