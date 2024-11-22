<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('acls', function (Blueprint $table) {
            $table->id('id')->autoIncrement();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('entity_type',['list','note']);
            $table->unsignedBigInteger('entity_id');//we need to manage the referentail integrity in application, may be observers
            $table->enum('permission',['viewer','editor','owner']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acl');
    }
};
