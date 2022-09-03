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
        Schema::create('roles', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')->constrained();
            $table->foreignId('project_id')->constrained();

            $table->enum('role',['responsable','participante']);

            $table->timestamps();
            
            $table->unique(['role','user_id','project_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
