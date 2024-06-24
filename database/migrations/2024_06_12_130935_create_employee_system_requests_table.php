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
        Schema::create('employee_system_requests', function (Blueprint $table) {
            $table->id();
            $table->date('birthdate');
            $table->date('joindate');
            $table->unsignedBigInteger('prefix_id');
            $table->foreign('prefix_id')->references('id')->on('prefixes');
            $table->string('thai_first_name');
            $table->string('thai_last_name');
            $table->string('eng_first_name');
            $table->string('eng_last_name');
            $table->integer('cid');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departmentes');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('medical_license_no');
            $table->date('medical_license_start');
            $table->date('medical_license_expire');
            $table->string('emp_username');
            $table->string('emp_password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_system_requests');
    }
};
