<?php

namespace App\Http\Controllers\Api;

use App\FuelFile;
use App\FuelTicket;
use App\Http\Controllers\ApiController;
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
     *     path="/1c/fuel_tickets",
     *     summary="Загрузка топливных талонов",
     *     tags={"1С"},
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

    /**
     * Получение информации о топливном талоне
     *
     * @param Request $request
     * @return Response
     *
     * @SWG\Post(
     *     path="/fuel_ticket",
     *     summary="Информация о топливном талоне",
     *     tags={"Mobile"},
     *     description="Получение информации о топливном талоне",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *          name="api_token",
     *          description="API Token",
     *          type="string",
     *          required=true,
     *          in="query"
     *      ),
     *      @SWG\Parameter(
     *          name="fuel_ticket",
     *          description="Штрихкод топливного талона",
     *          type="string",
     *          required=true,
     *          in="query"
     *      ),
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
     *                 property="fuel_ticket",
     *                 ref="#/definitions/FuelTicket"
     *             )
     *         )
     *     ),
     *     @SWG\Response(
     *          response=401,
     *          description="Unauthorized"
     *     ),
     *     @SWG\Response(
     *          response=404,
     *          description="Not Found"
     *     ),
     *     @SWG\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *     ),
     * )
     */
    public function getFuelTicketInfo(Request $request)
    {
        $this->validate($request, [
            'fuel_ticket' => 'required',
        ]);

        $fuelTicket = FuelTicket::where('code', $request->get('fuel_ticket'))->first();

        if( ! $fuelTicket) {
            return response()->json([
                'status' => 'not found',
                'message' => 'Топливный талон (' . $request->get('fuel_ticket') . ') не найден',
            ], 404);
        }

        return response()->json([
            'status' => 'ok',
            'message' => 'Топливный талон найден',
            'fuel_ticket' => $fuelTicket,
        ]);
    }

    /**
     * Использование топливных талонов
     *
     * @param Request $request
     * @return Response
     *
     * @SWG\Post(
     *     path="/use_fuel_tickets",
     *     summary="Использование топливных талонов",
     *     tags={"Mobile"},
     *     description="Использование топливных талонов",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *          name="api_token",
     *          description="API Token",
     *          type="string",
     *          required=true,
     *          in="query"
     *      ),
     *      @SWG\Parameter(
     *          name="fuel_tickets",
     *          description="Штрихкоды топливных талонов через запятую",
     *          required=true,
     *          in="formData",
     *          type="string"
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Топливные талоны успешно использованы",
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
     *                 property="found",
     *                 type="array",
     *                 @SWG\Items(type="string")
     *             ),
     *             @SWG\Property(
     *                 property="not_found",
     *                 type="array",
     *                 @SWG\Items(type="string")
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
    public function useFuelTickets(Request $request)
    {
        $this->validate($request, [
            'fuel_tickets' => 'required',
        ]);

        $fuelTickets = explode(',', $request->get('fuel_tickets'));
        $fuelTicketsStatus = [];
        foreach ($fuelTickets as $key => $value) {
            $fuelTickets[$key] = trim($value);

            $fuelTicket = FuelTicket::where('code', $fuelTickets[$key])->first();
            if( ! $fuelTicket) {
                $fuelTicketsStatus['not_found'][] = $fuelTickets[$key];
            } else {
                $fuelTicketsStatus['found'][] = $fuelTickets[$key];
            }
        }

        $message = isset($fuelTicketsStatus['found']) ? 'Топливные талоны (' . implode(', ', $fuelTicketsStatus['found']) . ') найдены. ' : '';
        $message.= isset($fuelTicketsStatus['not_found']) ? 'НЕ НАЙДЕНЫ ТАЛОНЫ (' . implode(', ', $fuelTicketsStatus['not_found']) . '). ' : '';

        return response()->json([
            'status' => 'ok',
            'message' => $message,
            'found' => isset($fuelTicketsStatus['found']) ? $fuelTicketsStatus['found'] : [],
            'not_found' => isset($fuelTicketsStatus['not_found']) ? $fuelTicketsStatus['not_found'] : [],
        ]);
    }
}
