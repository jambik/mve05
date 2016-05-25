<?php

namespace App\Console\Commands;

use App\FuelFile;
use App\FuelTicket;
use Excel;
use Illuminate\Console\Command;

class FuelFileManager extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:fuel_file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Импорт CSV файла топливных талонов';

    protected $chunkSize = 10;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $fuelFile = FuelFile::where('is_imported', '0')->orderBy('created_at', 'DESC')->firstOrFail();
        $this->info($fuelFile);

        $fuelFilePath = storage_path('fuel_tickets') . DIRECTORY_SEPARATOR . $fuelFile->file_name;

        // Count the total number of rows
        Excel::load($fuelFilePath, function($reader) use($fuelFile) {
            $objWorksheet = $reader->getActiveSheet();
            $fuelFile->rows_imported = 0;
            $fuelFile->total_rows = $objWorksheet->getHighestRow() - 1; // exclude the heading
            $fuelFile->save();
        });

        //now let's import the rows, one by one while keeping track of the progress
        Excel::filter('chunk')
            ->load($fuelFilePath)
            ->chunk($this->chunkSize, function($results) use ($fuelFile) {
                $rows = $results->toArray();
                //let's do more processing (change values in cells) here as needed
                $counter = 0;
                dd($results);
                foreach ($rows as $row) {

                    $fuelTicket = [
                        'code' => $row[0],
                        'type' => $row[1],
                        'serial' => (int) $row[2],
                        'fuel' => $row[3],
                        'liters' => (int) $row[4],
                        'ticket_sold_type' => $row[5],
                        'is_exchange' => Str::lower(trim($row[6])) === 'да',
                        'sold_at' => $row[7] ? Carbon::createFromFormat('d.m.Y', $row[7]) : null,
                        'sold_document' => $row[8],
                        'contractor' => $row[9],
                        'expired_at' => $row[10] ? Carbon::createFromFormat('d.m.Y', $row[10]) : null,
                        'purchase_price' => (float) str_replace(',', '.', $row[11]),
                        'retail_price' => (float) str_replace(',', '.', $row[12]),
                        'sold_price' => (float) str_replace(',', '.', $row[13]),
                        'ticket_sold_price' => (float) str_replace(',', '.', $row[14]),
                        'is_returned' => Str::lower(trim($row[15])) === 'да',
                        'is_returned_exchange' => Str::lower(trim($row[16])) === 'да',
                        'returned_type' => $row[17],
                        'gas_station' => $row[18],
                        'returned_at' => $row[19] ? Carbon::createFromFormat('d.m.Y', $row[19]) : null,
                        'returned_document' => $row[20],
                        'returned_purchase_price' => $row[21] ? (float) str_replace(',', '.', $row[21]) : null,
                        'returned_retail_price' => $row[22] ? (float) str_replace(',', '.', $row[22]) : null,
                        'returned_total_price' => $row[23] ? (float) str_replace(',', '.', $row[23]) : null,
                        'quantity' => (int) $row[24],
                    ];

                    FuelTicket::create($fuelTicket);
                    $counter++;

                }
                $fuelFile = $fuelFile->fresh(); //reload from the database
                $fuelFile->rows_imported += $counter;
                $fuelFile->save();

                dump($fuelFile);
            });

        $fuelFile->imported = 1;
        $fuelFile->save();
    }
}
