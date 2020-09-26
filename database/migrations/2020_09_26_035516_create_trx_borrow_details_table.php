<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxBorrowDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_borrow_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('trx_borrows_id');
            $table->foreign('trx_borrows_id')
                ->references('id')
                ->on('trx_borrows')
                ->onDelete('cascade');
            $table->unsignedBigInteger('books_id');
            $table->foreign('books_id')
                ->references('id')
                ->on('books')
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
Schema::table('trx_borrow_details', function (Blueprint $table) {
    $table->dropForeign(['trx_borrows_id']);
    $table->dropForeign(['books_id']);
});
Schema::dropIfExists('trx_borrow_details');
    }
}
