<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentIDsTable extends Migration
{
    public function up()
    {
        Schema::create('student_ids', function (Blueprint $table) {
            $table->id();
            $table->string('student_id_number')->unique();
            $table->unsignedBigInteger('student_id_type_id');
            $table->timestamps();

            $table->foreign('student_id_type_id')->references('id')->on('student_id_types');
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_ids');
    }
}
