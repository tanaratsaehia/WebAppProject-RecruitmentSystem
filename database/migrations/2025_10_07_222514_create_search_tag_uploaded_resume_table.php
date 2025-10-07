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
        Schema::create('search_tag_uploaded_resume', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('uploaded_resume_id')->constrained()->cascadeOnDelete();
            $table->foreignId('search_tag_id')->constrained()->cascadeOnDelete();
            $table->primary(['uploaded_resume_id', 'search_tag_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search_tag_uploaded_resume');
    }
};
