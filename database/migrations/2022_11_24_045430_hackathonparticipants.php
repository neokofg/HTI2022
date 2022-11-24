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
        Schema::create('hackathonparticipants', function (Blueprint $table) {
            $table->id();
            $table->string('teamid');
            $table->string('hackathonid');
            $table->string('checkpointnumber');
            $table->string('closestcheck')->nullable();
            $table->string('ready')->nullable();
            $table->string('comment')->nullable();
            $table->string('balls')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
