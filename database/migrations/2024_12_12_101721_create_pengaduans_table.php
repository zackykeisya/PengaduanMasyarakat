<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable()->default('');
            $table->string('provinsi');
            $table->string('regency')->nullable();
            $table->string('subdistrict')->nullable();
            $table->enum('type', ['KEJAHATAN', 'PEMBANGUNAN', 'SOSIAL'])->default('KEJAHATAN');
            $table->string('image')->nullable();
            $table->unsignedInteger('viewers')->default(0);
            $table->unsignedInteger('likes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};


