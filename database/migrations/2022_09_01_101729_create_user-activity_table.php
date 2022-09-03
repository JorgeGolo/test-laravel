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
        Schema::create('user-activity', function (Blueprint $table) {
            
            $table->id();

            $table->foreignId('user_id')->constrained();
            $table->foreignId('activity_id')->constrained();
            
            $table->enum('role',['responsable','participante']);

            $table->unique(['user_id','activity_id']);

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
        Schema::dropIfExists('user-activity');
    }
};
