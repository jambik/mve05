<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Str;

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
            'code' => $fields[1],
            'type' => $fields[2],
            'serial' => (int) $fields[3],
            'fuel' => $fields[4],
            'liters' => (int) $fields[5],
            'ticket_sold_type' => $fields[6],
            'is_exchange' => Str::lower(trim($fields[7])) === 'да',
            'sold_at' => $fields[8] ? Carbon::createFromFormat('d.m.Y', $fields[8]) : null,
            'sold_document' => $fields[9],
            'contractor' => $fields[10],
            'expired_at' => $fields[11] ? Carbon::createFromFormat('d.m.Y', $fields[11]) : null,
            'purchase_price' => (float) str_replace(',', '.', $fields[12]),
            'retail_price' => (float) str_replace(',', '.', $fields[13]),
            'sold_price' => (float) str_replace(',', '.', $fields[14]),
            'ticket_sold_price' => (float) str_replace(',', '.', $fields[15]),
            'is_returned' => Str::lower(trim($fields[16])) === 'да',
            'is_returned_exchange' => Str::lower(trim($fields[17])) === 'да',
            'returned_type' => $fields[18],
            'gas_station' => $fields[19],
            'returned_at' => $fields[20] ? Carbon::createFromFormat('d.m.Y', $fields[20]) : null,
            'returned_document' => $fields[21],
            'returned_purchase_price' => $fields[22] ? (float) str_replace(',', '.', $fields[22]) : null,
            'returned_retail_price' => $fields[23] ? (float) str_replace(',', '.', $fields[23]) : null,
            'returned_total_price' => $fields[24] ? (float) str_replace(',', '.', $fields[24]) : null,
            'quantity' => (int) $fields[25],
        ];

        return $fuelTicket;
    }
}
