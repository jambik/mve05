<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class FuelFileService
{
    public $fileName = '';

    public $filePath = '';

    public function __construct()
    {
        $this->filePath = storage_path('fuel_tickets');
    }

    public function uploadFile($fuelTicketsFile)
    {
        // File name
        $fileName = $this->generateFuelTicketsFileName();

        // Move uploaded file to directory
        try {
            $fuelTicketsFile->move($this->filePath, $fileName);
        } catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        // Full path to imported file
        $uploadedFile = $this->filePath . DIRECTORY_SEPARATOR . $fileName;

        return $uploadedFile;
    }

    public function generateFuelTicketsFileName()
    {
        $this->fileName = Carbon::now()->format('Y-m-d_H-i-s') . '.csv';
        return $this->fileName;
    }

    public static function processFuelTicketFields($fields)
    {
        $fuelTicket = [
            'code' => $fields[0],
            'type' => $fields[1],
            'serial' => (int) $fields[2],
            'fuel' => $fields[3],
            'liters' => (int) $fields[4],
            'ticket_sold_type' => $fields[5],
            'is_exchange' => Str::lower(trim($fields[6])) === 'да',
            'sold_at' => $fields[7] ? Carbon::createFromFormat('d.m.Y', $fields[7]) : null,
            'sold_document' => $fields[8],
            'contractor' => $fields[9],
            'expired_at' => $fields[10] ? Carbon::createFromFormat('d.m.Y', $fields[10]) : null,
            'purchase_price' => (float) str_replace(',', '.', $fields[11]),
            'retail_price' => (float) str_replace(',', '.', $fields[12]),
            'sold_price' => (float) str_replace(',', '.', $fields[13]),
            'ticket_sold_price' => (float) str_replace(',', '.', $fields[14]),
            'is_returned' => Str::lower(trim($fields[15])) === 'да',
            'is_returned_exchange' => Str::lower(trim($fields[16])) === 'да',
            'returned_type' => $fields[17],
            'gas_station' => $fields[18],
            'returned_at' => $fields[19] ? Carbon::createFromFormat('d.m.Y', $fields[19]) : null,
            'returned_document' => $fields[20],
            'returned_purchase_price' => $fields[21] ? (float) str_replace(',', '.', $fields[21]) : null,
            'returned_retail_price' => $fields[22] ? (float) str_replace(',', '.', $fields[22]) : null,
            'returned_total_price' => $fields[23] ? (float) str_replace(',', '.', $fields[23]) : null,
            'quantity' => (int) $fields[24],
        ];

        return $fuelTicket;
    }
}
