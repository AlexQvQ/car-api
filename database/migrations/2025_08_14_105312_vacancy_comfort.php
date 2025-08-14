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
        Schema::create('vacancy_comfort', function (Blueprint $table) {
            $table->unsignedBigInteger('comfort_class_id');
            $table->unsignedBigInteger('vacancy_id');
            $table->timestamps();

            $table->foreign('comfort_class_id')->references('id')->on('comfortclasses')->onDelete('cascade');
            $table->foreign('vacancy_id')->references('id')->on('vacancies')->onDelete('cascade');

            $table->primary(['comfort_class_id', 'vacancy_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
