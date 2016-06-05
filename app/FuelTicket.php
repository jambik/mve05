<?php

namespace App;

use App\Traits\ResourceableTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *      definition="FuelTicket",
 *      required={"code"},
 *      @SWG\Property(
 *          property="id",
 *          description="ID",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="code",
 *          description="Штрихкод",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="Вид талона",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="serial",
 *          description="Порядковый номер внутри вида талона",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="fuel",
 *          description="Марка топлива",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="liters",
 *          description="Номинал в литрах",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="ticket_sold_type",
 *          description="Вид продажи талона",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="is_exchange",
 *          description="Продан по обмену",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="sold_at",
 *          description="Дата продажи",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="sold_document",
 *          description="Документ продажи",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="contractor",
 *          description="Контрагент",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="expired_at",
 *          description="Действителен до",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="purchase_price",
 *          description="Закупочная цена на день продажи",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="retail_price",
 *          description="Розничная цена на день продажи",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="sold_price",
 *          description="Цена по которой продано топливо",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="ticket_sold_price",
 *          description="Цена по которой продан талон",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="is_returned",
 *          description="Талон вернулся",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="is_returned_exchange",
 *          description="Возвращен по обмену",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="returned_type",
 *          description="Вид возврата талона",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="gas_station",
 *          description="АЗС",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="returned_at",
 *          description="Дата возврата",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="returned_document",
 *          description="Документ возврата",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="returned_purchase_price",
 *          description="Закупочная цена на день возврата",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="returned_retail_price",
 *          description="Розничная цена на день возврата",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="returned_total_price",
 *          description="Цена по которой талон куплен у клиента",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="quantity",
 *          description="Количество",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="Дата создания записи",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="Дата последнего обновления записи",
 *          type="string",
 *          format="date"
 *      ),
 * )
 */
class FuelTicket extends Model
{
    use ResourceableTrait;

    protected $table = 'fuel_tickets';

    protected $fillable = [
        'code',
        'type',
        'serial',
        'fuel',
        'liters',
        'ticket_sold_type',
        'is_exchange',
        'sold_at',
        'sold_document',
        'contractor',
        'expired_at',
        'purchase_price',
        'retail_price',
        'sold_price',
        'ticket_sold_price',
        'is_returned',
        'is_returned_exchange',
        'returned_type',
        'gas_station',
        'returned_at',
        'returned_document',
        'returned_purchase_price',
        'returned_retail_price',
        'returned_total_price',
        'quantity',
    ];

    protected $casts = [
        'serial' => 'integer',
        'liters' => 'integer',
        'quantity' => 'integer',

        'is_exchange' => 'boolean',
        'is_returned' => 'boolean',
        'is_returned_exchange' => 'boolean',

        'purchase_price' => 'float',
        'retail_price' => 'float',
        'sold_price' => 'float',
        'ticket_sold_price' => 'float',
        'returned_purchase_price' => 'float',
        'returned_retail_price' => 'float',
        'returned_total_price' => 'float',
    ];

    protected $dates = [
        'sold_at',
        'expired_at',
        'returned_at',
        'created_at',
        'updated_at',
    ];
}
