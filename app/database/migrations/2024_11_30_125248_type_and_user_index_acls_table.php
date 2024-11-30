<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    //This migration is for index() method
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('acls', function (Blueprint $table) {
            $table->index(['user_id', 'entity_type']);
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('acls', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'entity_type']);
        });
    }
};
