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
        Schema::create('company', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('account_id');
            $table->index('account_id');
            $table->foreign('account_id')->references('id')->on('account')->onDelete('cascade');

            $table->unsignedBigInteger('i18n_country_id');
            $table->index('i18n_country_id');
            $table->foreign('i18n_country_id')->references('id')->on('i18n_country');

            $table->string('name');
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('address_complement')->nullable();
            $table->string('postal_code', 8)->nullable();
            $table->string('siret')->nullable();
            $table->string('ape_code', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
