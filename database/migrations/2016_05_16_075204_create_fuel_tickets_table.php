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

            $table->string('code', 32)->nullable();                        // Штрихкод
            $table->string('type', 32)->nullable();                        // Вид талона
            $table->integer('serial')->nullable();                         // Порядковый номер внутри вида талона
            $table->string('fuel', 32)->nullable();                        // Марка топлива
            $table->tinyInteger('liters')->nullable();                     // Номинал в литрах
            $table->string('ticket_sold_type', 32)->nullable();            // Вид продажи талона
            $table->boolean('is_exchange')->nullable();                    // Продан по обмену
            $table->dateTime('sold_at')->nullable();                       // Дата продажи
            $table->string('sold_document', 128)->nullable();              // Документ продажи
            $table->string('contractor', 64)->nullable();                  // Контрагент
            $table->dateTime('expired_at')->nullable();                    // Действителен до
            $table->decimal('purchase_price', 6, 2)->nullable();           // Закупочная цена на день продажи
            $table->decimal('retail_price', 6, 2)->nullable();             // Розничная цена на день продажи
            $table->decimal('sold_price', 6, 2)->nullable();               // Цена по которой продано топливо
            $table->decimal('ticket_sold_price', 8, 2)->nullable();        // Цена по которой продан талон
            $table->boolean('is_returned')->nullable();                    // Талон вернулся
            $table->boolean('is_returned_exchange')->nullable();           // Возвращен по обмену
            $table->string('returned_type')->nullable();                   // Вид возврата талона
            $table->string('gas_station')->nullable();                     // АЗС
            $table->dateTime('returned_at')->nullable();                   // Дата возврата
            $table->string('returned_document', 128)->nullable();          // Документ возврата
            $table->decimal('returned_purchase_price', 6, 2)->nullable();  // Закупочная цена на день возврата
            $table->decimal('returned_retail_price', 6, 2)->nullable();    // Розничная цена на день возврата
            $table->decimal('returned_total_price', 8, 2)->nullable();     // Цена по которой талон куплен у клиента
            $table->tinyInteger('quantity')->nullable();                   // Количество

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