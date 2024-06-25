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
        Schema::create('flows', function (Blueprint $table) {
            $table->id();
            $table->string('keyword');
            $table->text('answer')->change();
            $table->string('media_path')->nullable();
            $table->string('media_url')->nullable();
            $table->foreignId('chatbots_id')
            ->constrained('chatbots')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flows');
        Schema::table('flows', function (Blueprint $table) {
            $table->dropColumn('media_url');
        });
    }
};
