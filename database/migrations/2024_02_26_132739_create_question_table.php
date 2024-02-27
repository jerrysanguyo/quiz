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
        Schema::create('question', function (Blueprint $table) {
            $table->id();
            $table->integer('qNumber');
            $table->string('qDescription');
            $table->string('qAnswer');
            $table->string('qChoicesB');
            $table->string('qChoicesC');
            $table->string('qChoicesD');
            $table->foreignId('added_by')->references('id')->on('users')->onDelete('cascade')->after('qChoicesD');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question');
    }
};
