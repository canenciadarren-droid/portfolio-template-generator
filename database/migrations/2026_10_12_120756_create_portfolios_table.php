<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();

            // Basic personal information
            $table->string('full_name');
            $table->string('email');
            $table->string('contact_number', 30)->nullable();
            $table->string('address')->nullable();
            $table->string('photo_url', 2048)->nullable();

            // Portfolio content
            $table->text('about_me');
            $table->text('education')->nullable();
            $table->text('skills')->nullable();
            $table->text('projects')->nullable();
            $table->text('work_experience')->nullable();
            $table->text('social_links')->nullable();

            // Selected portfolio design
            $table->string('template', 20);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
