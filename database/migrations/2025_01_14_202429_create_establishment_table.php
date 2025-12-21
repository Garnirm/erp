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
        Schema::create('establishment', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('account_id');
            $table->index('account_id');
            $table->foreign('account_id')->references('id')->on('account')->onDelete('cascade');

            $table->unsignedBigInteger('i18n_country_id');
            $table->index('i18n_country_id');
            $table->foreign('i18n_country_id')->references('id')->on('i18n_country');

            $table->string('city');
            $table->string('name');
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('establishment');
    }
};
