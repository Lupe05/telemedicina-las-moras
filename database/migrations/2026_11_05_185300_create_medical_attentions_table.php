
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_attentions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('appointment_id')
                ->unique()
                ->constrained('appointments')
                ->restrictOnDelete();

            $table->dateTime('attention_date');

            $table->longText('clinical_notes');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_attentions');
    }
};
