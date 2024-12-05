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
        Schema::table('acls', function (Blueprint $table) {
            $table->index('user_id','acls_user_id_ix');
            $table->index(['entity_type','entity_id'],'acls_entity_type_entity_id_ix');
            $table->unique(['user_id','entity_type','entity_id'],'acls_user_id_entity_type_entity_id_uq');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('acls', function (Blueprint $table) {
            if (Schema::hasColumn('acls', 'user_id')) {
                $table->dropForeign(['user_id']);
            }
            $table->dropIndex('acls_user_id_ix');
            $table->dropIndex('acls_entity_type_entity_id_ix');
            $table->dropUnique('acls_user_id_entity_type_entity_id_uq');
        });
    }
};
