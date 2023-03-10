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
        Schema::create('money_checks', function (Blueprint $table) {
            $table->id();
            $table->uuid('ref_key')->unique();
            $table->string('data_version', 255);
            $table->boolean('deletion_mark');
            $table->unsignedBigInteger('number');
            $table->dateTime('date');
            $table->boolean('posted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('money_cheks');
    }
};
