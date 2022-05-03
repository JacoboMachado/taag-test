<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookOnShelvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_on_shelves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')
                ->references('id')
                ->on('books')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('shelve_id')
                ->references('id')
                ->on('shelves')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_on_shelves');
    }
}
