
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
        Schema::create('transcripts', function (Blueprint $table) {
            $table->id();
            $table->string('document_id', 50)->unique();
            $table->unsignedBigInteger('student_id');
            $table->integer('batch_id')->nullable();
            $table->decimal('fgpa', 3, 2)->nullable();
            $table->string('class_name', 100)->nullable();
            $table->string('degree_name', 255)->nullable();
            $table->date('effective_date')->nullable();
            $table->enum('status', ['active', 'revoked', 'superseded'])->default('active');
            $table->text('status_reason')->nullable();
            $table->unsignedInteger('status_updated_by')->nullable();
            $table->unsignedInteger('issued_by')->nullable();
            $table->timestamp('issued_at')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('student_personal_details')->onDelete('cascade');
            $table->foreign('status_updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('issued_by')->references('id')->on('users')->onDelete('set null');

            $table->index('document_id');
            $table->index('student_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transcripts');
    }
};