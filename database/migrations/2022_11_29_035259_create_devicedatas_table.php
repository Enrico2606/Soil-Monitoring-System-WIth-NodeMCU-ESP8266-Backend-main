<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devicedatas', function (Blueprint $table) {
            $table->id();
            $table->string('created_at');
            $table->string('updated_at');
            $table->integer('alat_id')->unsigned();
            $table->float('kelembapan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devicedatas');
    }
};
