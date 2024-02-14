<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aquacultures', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(\Illuminate\Support\Str::uuid());    
            $table->string('ponds');
            $table->string('gender');
            $table->string('district');
            $table->string('village');
            $table->string('geojsonPonds');
            $table->string('imagePonds');
            $table->string('cultivationType');
            $table->float('pondArea');
            $table->string('cultivationStage');
            $table->string('status');        
            $table->integer('number');            
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aquacultures');
    }
};
