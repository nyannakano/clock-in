<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('workloads', function (Blueprint $table) {
            $table->id();
            $table->integer('total_hours_day');
            $table->integer('total_days_week');
            $table->unsignedBigInteger('employee_id');
            $table->integer('interval_hours')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workloads');
    }
};
