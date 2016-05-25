<?php

namespace App\Http\Controllers\Api;

use App\FuelFile;
use App\FuelTicket;
use App\Http\Controllers\ApiController;
use Artisan;
use Auth;
use Carbon\Carbon;
use Excel;
use Flash;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;
use Validator;

class FuelTicketController extends ApiController
{
    public function uploadFuelTicketsFile(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'file' => 'required',
        ]);

        // Get file
        $fuelTicketsFile = $request->file('file');

        // Additional validation rules
        $validator->after(function($validator) use ($fuelTicketsFile) {
            if ($fuelTicketsFile->getClientOriginalExtension() !== 'csv') {
                $validator->errors()->add('file', 'Неверное расширение файла - допускается только файлы с расширением .csv');
            }

            if ($fuelTicketsFile->getClientMimeType() !== 'application/vnd.ms-excel') {
                $validator->errors()->add('file', 'Неверный формат файла - допускается только файл формата CSV разделитель - ;');
            }
        });

        // Go back with errors if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // File name
        $fileName = Carbon::now()->format('Y-m-d_H-i-s') . '.csv';
        // File path
        $fullPath = storage_path('fuel_tickets');

        // Move uploaded file to directory
        try {
            $fuelTicketsFile->move($fullPath, $fileName);
        } catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        // Full path to imported file
        $uploadedFile = $fullPath . DIRECTORY_SEPARATOR . $fileName;

        if ($request->has('show_progress') && $request->get('show_progress')) {

            // Create fuel file record
            $fuelFile = FuelFile::firstOrNew(['file_name' => $fileName]);
            $fuelFile->is_imported = false; // file was not imported
            $fuelFile->user_id = Auth::check() ? Auth::id() : 0;
            $fuelFile->save();

            // Run command import:fuel_file
//            $process = new Process('php ../artisan import:fuel_file');
//            $process->start();

            // Run artisan command
//            $exitCode = Artisan::call('import:fuel_file');
//            dump($exitCode);

            $fuelFile = FuelFile::where('is_imported', '0')->orderBy('created_at', 'DESC')->firstOrFail();

            $fuelFilePath = storage_path('fuel_tickets') . DIRECTORY_SEPARATOR . $fuelFile->file_name;

            // Count the total number of rows
            Excel::load($fuelFilePath, function ($reader) use ($fuelFile) {
                $objWorksheet = $reader->getActiveSheet();
                $fuelFile->rows_imported = 0;
                $fuelFile->total_rows = $objWorksheet->getHighestRow() - 1; // exclude the heading
                $fuelFile->save();
            });

            // Import file to database
            $result = Excel::load($uploadedFile, null, 'cp1251');
            dd($result->toArray());
            $result->chunk(10, function($results){
                dd($results);
            });
            dd($result->toArray());
            $result->chunk(10, function($results) {
                dd($results);
            });

            /*Excel::filter('chunk')
                ->selectSheetsByIndex(0)
                ->load($uploadedFile)
                ->chunk(10, function($result) {
                    $rows = $result->toArray();
                    foreach ($rows as $k => $row) {
                        foreach ($row as $c => $cell) {
                            dump($cell);
                        }

                    }
                });
            dd();*/

            //now let's import the rows, one by one while keeping track of the progress
            Excel::filter('chunk')
                ->load($fuelFilePath)
                ->chunk(10, function($results) use ($fuelFile) {
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
                });

            $fuelFile->imported = 1;
            $fuelFile->save();


        } else {

            // Import file to database
            Excel::load($uploadedFile, function ($reader) {
                $reader->noHeading();
                $rows = $reader->skip(1)->toArray();
                foreach ($rows as $k => $row) {

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
                }
            }, 'cp1251');

        }

        // Show success result
        Flash::success('Файл обработан');
        return redirect()->back();
    }
}
