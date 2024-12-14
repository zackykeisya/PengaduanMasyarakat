<?php

// database/migrations/2024_12_14_123457_create_komentars_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomentarsTable extends Migration
{
    public function up()
    {
        // Example migration for creating komentar table
Schema::create('komentars', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pengaduan_id')->constrained()->onDelete('cascade');
    $table->text('comment');
    $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // optional if using user association
    $table->timestamps();
});

        
    }

    public function down()
    {
        Schema::dropIfExists('komentars');
    }
}
