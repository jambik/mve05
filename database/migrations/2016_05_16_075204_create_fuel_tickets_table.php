<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuelTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_tickets', function (Blueprint $table) {
            $table->increments('id');

            $table->string('code', 32); //Штрихкод
            $table->string('type', 32); //Вид талона
            $table->integer('serial'); //Порядковый номер внутри вида талона
            $table->string('fuel', 32); //Марка топлива
            $table->tinyInteger('liters'); //Номинал в литрах
            $table->string('ticket_sold_type', 32); //Вид продажи талона
            $table->boolean('exchange'); //Продан по обмену
            $table->dateTime('sold_at'); //Дата продажи
            $table->string('sold_document', 128); //Документ продажи
            $table->string('contractor', 64); //Контрагент
            $table->dateTime('expired_at'); //Действителен до
            $table->decimal('purchase_price', 6, 2); //Закупочная цена на день продажи
            $table->decimal('retail_price', 6, 2); //Розничная цена на день продажи
            $table->decimal('sold_price', 6, 2); //Цена по которой продано топливо
            $table->decimal('ticket_sold_price', 8, 2); //Цена по которой продан талон
            $table->boolean('returned'); //Талон вернулся
            $table->boolean('returned_exchange'); //Возвращен по обмену
            $table->string('returned_type'); //Вид возврата талона
            $table->string('gas_station'); //АЗС
            $table->dateTime('returned_at'); //Дата возврата
            $table->string('returned_document', 128); //Документ возврата
            $table->decimal('returned_purchase_price', 6, 2); //Закупочная цена на день возврата
            $table->decimal('returned_retail_price', 6, 2); //Розничная цена на день возврата
            $table->decimal('returned_total_price', 8, 2); //Цена по которой талон куплен у клиента
            $table->tinyInteger('quantity'); //Количество

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
        Schema::drop('fuel_tickets');
    }
}