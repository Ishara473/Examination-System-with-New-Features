<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('verification_audit_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('transcript_id')->nullable()->after('id');
            $table->foreign('transcript_id')->references('id')->on('transcripts')->onDelete('set null');
            $table->index('transcript_id');
        });
    }

    public function down(): void
    {
        Schema::table('verification_audit_logs', function (Blueprint $table) {
            $table->dropForeign(['transcript_id']);
            $table->dropColumn('transcript_id');
        });
    }
};

