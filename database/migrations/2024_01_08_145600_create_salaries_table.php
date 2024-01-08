<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('position_id');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('hra', 10, 2);
            $table->decimal('da', 10, 2);
            $table->decimal('other_allowances', 10, 2);
            $table->decimal('gross_salary', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
