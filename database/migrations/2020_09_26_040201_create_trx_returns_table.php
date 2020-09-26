<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_returns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('trx_borrows_id');
            $table->foreign('trx_borrows_id')
                ->references('id')
                ->on('trx_borrows')
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
        Schema::table('trx_returns', function (Blueprint $table) {
            $table->dropForeign(['trx_borrows_id']);
        });
        Schema::dropIfExists('trx_returns');
    }
}
