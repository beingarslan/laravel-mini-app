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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('uv_code_id')->nullable()->constrained('uvc_codes')->onDelete('cascade');
            $table->foreignId('constituency_id')->nullable()->constrained('constituencies')->onDelete('cascade');
            $table->boolean('is_election_commission_officer')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['uv_code_id']);
            $table->dropForeign(['constituency_id']);
        });
    }
};
