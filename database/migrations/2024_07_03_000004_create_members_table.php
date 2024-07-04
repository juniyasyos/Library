<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id(); // Kolom 'id' untuk primary key
            $table->string('full_name');
            $table->enum('member_type', ['Mahasiswa', 'Dosen', 'Staf']);
            $table->unsignedBigInteger('department_id');
            $table->string('phone_number', 20);
            $table->string('email')->unique();
            $table->string('address');
            $table->date('join_date');
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    public function down()
    {
        Schema::dropIfExists('members');
    }
}
