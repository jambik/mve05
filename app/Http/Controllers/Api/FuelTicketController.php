<?php

namespace App\Http\Controllers\Api;

use App\FuelFile;
use App\FuelTicket;
use App\Http\Controllers\ApiController;
use App\Http\Requests;
use App\Services\FuelFileService;
use Illuminate\Http\Request;
use Auth;
use Excel;
use Validator;

class FuelTicketController extends ApiController
{
    protected $validator;

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Post(
     *     path="/fuel_tickets",
     *     summary="Загрузка топливных талонов",
     *     tags={"Загрузка топливных талонов"},
     *     description="Загрузка файла топливных талонов в формате CSV",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *          name="api_token",
     *          description="API Token",
     *          type="string",
     *          required=true,
     *          in="query"
     *      ),
     *     @SWG\Parameter(
     *          name="file",
     *          description="Файл топливных талонов в формате CSV",
     *          type="file",
     *          required=true,
     *          in="formData"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Файл успешно импортирован",
     *         @SWG\Schema(
     *             type="object",
     *             @SWG\Property(
     *                 property="status",
     *                 type="string"
     *             ),
     *             @SWG\Property(
     *                 property="message",
     *                 type="string"
     *             ),
     *             @SWG\Property(
     *                 property="payload",
     *                 type="object"
     *             )
     *         )
     *     ),
     *     @SWG\Response(
     *          response=401,
     *          description="Unauthorized"
     *     ),
     *     @SWG\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *     ),
     * )
     */
    public function uploadFuelTicketsFile(Request $request)
    {
        $fuelFileManager = new FuelFileService();

        if ( ! $this->validateFile($request)) {
            return response()->json($this->validator->errors(), 422);
        }

        $uploadedFile = $fuelFileManager->uploadFile($request->file('file'));

        // Create fuel file record
        $fuelFile = FuelFile::firstOrNew(['file_name' => $fuelFileManager->fileName]);
        $fuelFile->is_imported = false;
        $fuelFile->user_id = Auth::guard('api')->id();
        $fuelFile->save();

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

        // Show success result
        return response()->json([
            'status' => 'ok',
            'message' => 'Файл обработан',
            'payload' => [
                'rows_imported' => $fuelFile->rows_imported,
                'total_rows' => $fuelFile->total_rows,
            ]
        ]);
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
