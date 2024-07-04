<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentIDTypesTable extends Migration
{
    public function up()
    {
        Schema::create('student_id_types', function (Blueprint $table) {
            $table->id();
            $table->string('student_id_type_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_id_types');
    }
}
