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
        Schema::create('job_opening_search_tag', function (Blueprint $table) {
            $table->foreignId('job_opening_id')->constrained()->cascadeOnDelete();
            $table->foreignId('search_tag_id')->constrained()->cascadeOnDelete();
            $table->primary(['job_opening_id', 'search_tag_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_opening_search_tag');
    }
};
// php artisan make:migration create_search_tag_uploaded_resume_table --create=search_tag_uploaded_resume
// php artisan make:migration create_search_tag_user_table --create=search_tag_user