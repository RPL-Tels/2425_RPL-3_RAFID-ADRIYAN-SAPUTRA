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
        Schema::create('project_history', function (Blueprint $table) {
            $table->id();
            $table->string('project_id')->nullable();
            $table->string('items_id')->nullable();
            $table->string('name');
            $table->string('by');
            $table->text('description');
            $table->string('status');
            $table->string('progress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_history');
    }
};
