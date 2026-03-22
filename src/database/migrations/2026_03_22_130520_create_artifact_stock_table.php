<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artifact_stock', function (Blueprint $table): void {
            $table->foreignId('artifact_id')->primary()->constrained('artifacts')->cascadeOnDelete();
            $table->unsignedInteger('opened_count')->default(0);
            $table->unsignedInteger('unopened_count')->default(0);
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artifact_stock');
    }
};
