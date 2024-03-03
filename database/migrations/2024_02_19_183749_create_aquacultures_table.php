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
        Schema::create('aquacultures', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(\Illuminate\Support\Str::uuid());    
            $table->longText('geojsonPonds');
            $table->string('ponds');
            $table->string('gender');
            $table->string('district');
            $table->string('village');
            $table->float('pondArea');
            $table->string('imagePonds');        
            $table->string('status');  
            $table->string('cultivationType')->nullable();
            $table->string('cultivationStage')->nullable();                           
            
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
