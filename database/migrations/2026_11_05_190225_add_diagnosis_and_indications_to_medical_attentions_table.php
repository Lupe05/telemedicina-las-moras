
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medical_attentions', function (Blueprint $table) {
            $table->longText('diagnosis')->nullable();
            $table->longText('indications')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('medical_attentions', function (Blueprint $table) {
            $table->dropColumn(['diagnosis', 'indications']);
        });
    }
};
