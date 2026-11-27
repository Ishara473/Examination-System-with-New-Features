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
        Schema::create('verification_audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('document_id_searched', 50)->nullable();
            $table->string('registration_no_searched', 50)->nullable();
            $table->enum('verification_method', ['qr_code', 'manual'])->default('qr_code');
            $table->boolean('is_valid')->default(false);
            $table->string('failure_reason', 100)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            $table->index('document_id_searched');
            $table->index('ip_address');
            $table->index('is_valid');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verification_audit_logs');
    }
};

