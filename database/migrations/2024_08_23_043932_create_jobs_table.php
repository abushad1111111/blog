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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id(); 
            $table->string('title')->nullable();; 
            $table->text('description')->nullable();
            $table->text('requirements')->nullable(); 
            $table->text('responsibilities')->nullable(); 
            $table->string('company')->nullable(); 
            $table->string('location')->nullable(); 
            $table->decimal('salary_min', 10, 2)->nullable(); 
            $table->decimal('salary_max', 10, 2)->nullable(); 
            $table->string('employment_type')->nullable(); 
            $table->string('experience_level')->nullable(); 
            $table->string('education_level')->nullable();
            $table->string('industry')->nullable(); 
            $table->string('posted_at')->nullable(); 
            $table->string('expires_at')->nullable(); 
            $table->string('application_deadline')->nullable(); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
