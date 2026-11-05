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
    Schema::create('medical_indications', function (Blueprint $table) {
        $table->id();

        $table->foreignId('medical_record_id')
            ->constrained('medical_records')
            ->cascadeOnDelete();

        $table->text('description');
        $table->text('instructions')->nullable();
        $table->date('indication_date')->nullable();

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('medical_indications');
}
};
