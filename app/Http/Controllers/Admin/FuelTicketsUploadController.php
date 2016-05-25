<?php

namespace App\Http\Controllers\Admin;

use App\FuelFile;
use App\FuelTicket;
use App\Http\Controllers\BackendController;
use App\Services\FuelFileService;
use Auth;
use Excel;
use Flash;
use Illuminate\Http\Request;
use Validator;

class FuelTicketsUploadController extends BackendController
{
    protected $validator;

    public function show()
    {
        return view('admin.fuel_tickets_upload.show');
    }

    public function upload(Request $request)
    {
        $fuelFileManager = new FuelFileService();

        if ( ! $this->validateFile($request)) {
            return redirect()->back()->withErrors($this->validator);
        }

        $uploadedFile = $fuelFileManager->uploadFile($request->file('file'));

        // Create fuel file record
        $fuelFile = FuelFile::firstOrNew(['file_name' => $fuelFileManager->fileName]);
        $fuelFile->is_imported = false;
        $fuelFile->user_id = Auth::id();
        $fuelFile->save();

        if ($request->has('show_progress') && $request->get('show_progress')) {

            // Run artisan command
            $exitCode = Artisan::call('import:fuel_file');

        } else {

            // Count the total number of rows
            Excel::load($uploadedFile, function ($reader) use ($fuelFile) {
                $objWorksheet = $reader->getActiveSheet();
                $fuelFile->rows_imported = 0;
                $fuelFile->total_rows = $objWorksheet->getHighestRow() - 1; // exclude the heading
                $fuelFile->save();
            });

            // Import file to database
            Excel::load($uploadedFile, function ($reader) {
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

        // Show success result
        Flash::success('Файл обработан');
        return redirect()->back();
    }

    public function validateFile(Request $request, $fileName = 'file')
    {
        // Validation rules
        $this->validator = Validator::make($request->all(), [
            $fileName => 'required',
        ]);

        // Get file
        $fuelTicketsFile = $request->file($fileName);

        // Additional validation rules
        $this->validator->after(function() use ($fuelTicketsFile, $fileName) {
            if ($fuelTicketsFile && $fuelTicketsFile->getClientOriginalExtension() !== 'csv') {
                $this->validator->errors()->add($fileName, 'Неверное расширение файла - допускается только файлы с расширением .csv');
            }

            if ($fuelTicketsFile && $fuelTicketsFile->getClientMimeType() !== 'application/vnd.ms-excel') {
                $this->validator->errors()->add($fileName, 'Неверный формат файла - допускается только файл формата CSV разделитель - ;');
            }
        });

        // Check if validation fails
        if ($this->validator->fails()) {
            return false;
        }

        return true;
    }
}
