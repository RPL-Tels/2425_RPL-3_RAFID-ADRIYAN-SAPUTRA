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
        Schema::create('project_details', function (Blueprint $table) {
            $table->id();
            $table->string('project_id')->unique();
            $table->string('project_name');
            $table->string('client_id');
            $table->string('client_name');
            $table->string('tumbnail')->nullable();
            $table->text('description');
            $table->string('category');
            $table->date('start');
            $table->date('due_contract');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_details');
    }
};
