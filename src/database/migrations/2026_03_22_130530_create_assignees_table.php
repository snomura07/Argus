<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assignees', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('assignee_type', 32);
            $table->timestamps();

            $table->index(['assignee_type', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assignees');
    }
};
