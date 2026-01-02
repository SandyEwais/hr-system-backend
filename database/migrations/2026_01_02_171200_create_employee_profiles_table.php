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
        Schema::create('employee_profiles', function (Blueprint $table) {
            $table->id();
             $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->string('marital_status')->nullable();
            $table->date('date_of_birth')->nullable();

            $table->string('personal_email')->nullable();
            $table->string('contact_number')->nullable();

            $table->integer('building_number')->nullable();
            $table->string('street_name')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_profiles');
    }
};
