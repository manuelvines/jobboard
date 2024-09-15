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
            $table->string('title', 100);
            $table->longText('description');

            $table->decimal('min_salary', 10, 2)->nullable();
            $table->decimal('max_salary', 10, 2)->nullable();

            $table->boolean("show_salary")->default(false);


            $table->foreignId('type_id')->constrained();
            $table->foreignId('workday_id')->constrained();
            $table->foreignId('education_id')->constrained();

            $table->foreignId('modality_id')->constrained();
            $table->foreignId('category_id')->constrained();

            $table->foreignId('country_id')->constrained();
            $table->foreignId('state_id')->constrained();
            
            $table->foreignId('user_id')->constrained();

            
            $table->softDeletes();

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
