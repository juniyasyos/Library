<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn', 20)->unique();
            $table->string('title');
            $table->string('publisher');
            $table->integer('publication_year');
            $table->string('edition')->nullable();
            $table->integer('pages');
            $table->unsignedBigInteger('category_id');
            $table->string('shelf_location');
            $table->integer('available_quantity');
            $table->integer('total_quantity');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
