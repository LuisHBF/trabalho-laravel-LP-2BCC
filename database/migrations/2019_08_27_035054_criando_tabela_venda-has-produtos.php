<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriandoTabelaVendaHasProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendasHasProdutos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_venda');
            $table->unsignedBigInteger('id_produto');
            $table->integer('quantidade');
            $table->foreign('id_venda')->references('id')->on('vendas');
            $table->foreign('id_produto')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
