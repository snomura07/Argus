<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artifacts', function (Blueprint $table): void {
            $table->id();
            $table->string('artifact_type', 32);
            $table->string('name');
            $table->string('maker')->nullable();
            $table->string('model')->nullable();
            $table->string('cpu')->nullable();
            $table->unsignedInteger('memory_gb')->nullable();
            $table->unsignedInteger('storage_gb')->nullable();
            $table->string('display_size', 32)->nullable();
            $table->timestamps();

            $table->index(['artifact_type', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artifacts');
    }
};
