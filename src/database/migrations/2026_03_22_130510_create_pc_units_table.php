<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pc_units', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('artifact_id')->constrained('artifacts')->cascadeOnDelete();
            $table->string('management_no')->unique();
            $table->string('status', 32);
            $table->date('received_at')->nullable();
            $table->boolean('warranty')->default(false);
            $table->timestamps();

            $table->index(['artifact_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pc_units');
    }
};
