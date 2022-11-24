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
        Schema::create('hackathons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('date');
            $table->text('teams')->nullable();
            $table->text('checkpoints')->nullable();
            $table->string('prize');
            $table->string('sponsors')->nullable();
            $table->string('image')->nullable();
            $table->string('experts')->nullable();
            $table->string('trackers')->nullable();
            $table->text('description');
            $table->text('tracks');
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
