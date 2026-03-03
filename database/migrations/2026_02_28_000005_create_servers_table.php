<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('ip_address', 45);
            $table->enum('type', ['WEB', 'DATABASE']);

            $table->string('os_name', 100)->nullable();
            $table->string('provider', 100)->nullable();
            $table->string('location', 100)->nullable();

            $table->integer('cpu_cores')->nullable();
            $table->integer('ram_gb')->nullable();
            $table->integer('storage_gb')->nullable();

            $table->enum('status', ['ACTIVE', 'MAINTENANCE', 'DECOMMISSIONED'])->default('ACTIVE');
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};
