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
        Schema::create('user', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('account_id');
            $table->index('account_id');
            $table->foreign('account_id')->references('id')->on('account')->onDelete('cascade');

            $table->unsignedBigInteger('i18n_country_id');
            $table->index('i18n_country_id');
            $table->foreign('i18n_country_id')->references('id')->on('i18n_country');

            $table->unsignedBigInteger('i18n_lang_id');
            $table->index('i18n_lang_id');
            $table->foreign('i18n_lang_id')->references('id')->on('i18n_lang');

            $table->unsignedBigInteger('i18n_timezone_id');
            $table->index('i18n_timezone_id');
            $table->foreign('i18n_timezone_id')->references('id')->on('i18n_timezone');

            $table->string('email', 150);
            $table->index('email');

            $table->string('password');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('fullname_first');
            $table->string('fullname_last');
            $table->string('avatar');
            $table->string('date_format', 40)->default('DD/MM/YYYY');
            $table->boolean('active')->default(false);
            $table->dateTime('enabled_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
