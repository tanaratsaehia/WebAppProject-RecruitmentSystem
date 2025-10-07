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
        Schema::table('uploaded_resumes', function (Blueprint $table) {
            $table->string('resume_path')->nullable()->after('resume_file_name');
            $table->integer('resume_size')->nullable()->after('resume_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('uploaded_resumes', function (Blueprint $table) {
            $table->dropColumn(['resume_path','resume_size']);
        });
    }
};
