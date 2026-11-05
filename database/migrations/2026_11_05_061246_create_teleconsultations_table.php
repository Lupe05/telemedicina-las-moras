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
    Schema::create('teleconsultations', function (Blueprint $table) {
        $table->id();

        $table->foreignId('appointment_id')
            ->unique()
            ->constrained('appointments')
            ->cascadeOnDelete();

        $table->string('meeting_link')->nullable();
        $table->dateTime('started_at')->nullable();
        $table->dateTime('ended_at')->nullable();
        $table->string('status')->default('Programada');
        $table->text('notes')->nullable();

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('teleconsultations');
}
};
