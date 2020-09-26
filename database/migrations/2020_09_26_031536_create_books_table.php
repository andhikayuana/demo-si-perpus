<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('total')->unsigned()->nullable();
            $table->string('cover_url')->nullable()->default('https://via.placeholder.com/150x150.png?text=SI+Perpus');
            $table->unsignedBigInteger('book_categories_id');
            $table->foreign('book_categories_id')
                ->references('id')
                ->on('book_categories')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['book_categories_id']);
        });
        Schema::dropIfExists('books');
    }
}
