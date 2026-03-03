<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('url', 255)->unique();

            $table->foreignId('type_id')->nullable()->constrained('site_types')->nullOnDelete();
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->foreignId('responsible_user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->foreignId('web_server_id')->nullable()->constrained('servers')->nullOnDelete();
            $table->foreignId('db_server_id')->nullable()->constrained('servers')->nullOnDelete();

            $table->string('server_username', 100)->nullable();
            $table->string('server_path', 255)->nullable();
            $table->string('database_name', 100)->nullable();
            $table->string('database_username', 100)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
