<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxBorrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_borrows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('members_id');
            $table->foreign('members_id')
                ->references('id')
                ->on('members')
                ->onDelete('cascade');
            $table->timestamp('borrowed_at');
            $table->timestamp('due_return_at');
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
        Schema::table('trx_borrows', function (Blueprint $table) {
            $table->dropForeign(['members_id']);
        });
        Schema::dropIfExists('trx_borrows');
    }
}
