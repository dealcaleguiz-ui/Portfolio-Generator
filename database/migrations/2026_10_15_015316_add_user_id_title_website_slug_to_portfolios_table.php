<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')
                  ->constrained()->cascadeOnDelete();
            $table->string('title')->nullable()->after('full_name');
            $table->string('website')->nullable()->after('address');
            $table->string('slug')->nullable()->unique()->after('template');
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn(['title', 'website', 'slug']);
        });
    }
};