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
    Schema::create('ponds_progress', function (Blueprint $table) {
        $table->id();
        $table->uuid('uuid')->default(\Illuminate\Support\Str::uuid());
        $table->string('ponds');
        $table->string('gender');
        $table->string('district');
        $table->string('village');
        $table->string('imagePonds');
        $table->string('cultivationType');
        $table->string('cultivationStage');
        $table->string('status'); 
        $table->string('geojsonPonds')->nullable(); 
        $table->integer('number');
        $table->timestamps();
    });
}

};

