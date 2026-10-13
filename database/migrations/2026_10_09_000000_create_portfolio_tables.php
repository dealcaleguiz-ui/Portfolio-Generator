<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Main portfolio (personal information + chosen template)
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone', 50)->nullable();
            $table->string('address')->nullable();
            $table->text('about')->nullable();
            $table->longText('photo')->nullable();      // profile picture saved as Base64
            $table->string('template')->nullable();     // simple | modern | creative
            $table->timestamps();
        });

        // Education
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained()->cascadeOnDelete();
            $table->string('school_name')->nullable();
            $table->string('education_level')->nullable();
            $table->string('program')->nullable();
            $table->string('year')->nullable();
            $table->timestamps();
        });

        // Skills
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained()->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        // Projects
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained()->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });

        // Work experience
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained()->cascadeOnDelete();
            $table->string('position')->nullable();
            $table->string('company')->nullable();
            $table->string('duration')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Social media links
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained()->cascadeOnDelete();
            $table->string('platform')->nullable();
            $table->string('url', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('links');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('education');
        Schema::dropIfExists('portfolios');
    }
};