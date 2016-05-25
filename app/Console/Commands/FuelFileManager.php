<?php

namespace App\Console\Commands;

use App\FuelFile;
use App\FuelTicket;
use App\Services\FuelFileService;
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

        $fuelFilePath = storage_path('fuel_tickets') . DIRECTORY_SEPARATOR . $fuelFile->file_name;

        // Count the total number of rows
        Excel::load($fuelFilePath, function($reader) use($fuelFile) {
            $objWorksheet = $reader->getActiveSheet();
            $fuelFile->rows_imported = 0;
            $fuelFile->total_rows = $objWorksheet->getHighestRow() - 1; // exclude the heading
            $fuelFile->save();
        });

        //now let's import the rows, one by one while keeping track of the progress
        Excel::load($fuelFilePath, function ($reader) {
            $reader->noHeading();
            $rows = $reader->skip(1)->toArray();

            foreach ($rows as $k => $row) {
                $fuelTicket = FuelFileService::processFuelTicketFields($row);
                FuelTicket::create($fuelTicket);
            }
        }, 'cp1251');

        $fuelFile->is_imported = 1;
        $fuelFile->rows_imported = $fuelFile->total_rows;
        $fuelFile->save();
    }
}
