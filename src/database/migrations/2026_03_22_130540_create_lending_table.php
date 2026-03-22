<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lending', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('artifact_id')->constrained('artifacts')->cascadeOnDelete();
            $table->foreignId('assignee_id')->constrained('assignees')->cascadeOnDelete();
            $table->unsignedInteger('quantity');
            $table->string('lending_type', 32);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();

            $table->index(['artifact_id', 'assignee_id']);
            $table->index(['lending_type', 'start_date', 'end_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lending');
    }
};
