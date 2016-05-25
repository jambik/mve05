<?php

namespace App;

use App\Traits\ResourceableTrait;
use Illuminate\Database\Eloquent\Model;

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
