<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('configurations', function (Blueprint $table) {
            $table->renameColumn('shoul_block_weekends', 'should_block_weekends');
        });
    }

    public function down(): void
    {
        Schema::table('configurations', function (Blueprint $table) {
            $table->renameColumn('should_block_weekends', 'shoul_block_weekends');
        });
    }
};
