<?php

namespace App\Http\Controllers\Api;

use Agent;
use App\Http\Controllers\ApiController;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class AuthController extends ApiController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *     path="/1c/auth",
     *     summary="Авторизация",
     *     tags={"1С"},
     *     description="Авторизация и получение api_token",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *          name="email",
     *          description="Email (логин)",
     *          type="string",
     *          required=true,
     *          in="query"
     *      ),
     *     @SWG\Parameter(
     *          name="password",
     *          description="Пароль",
     *          type="string",
     *          required=true,
     *          in="query"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="успешная авторизация",
     *         @SWG\Schema(
     *             type="object",
     *             @SWG\Property(
     *                 property="api_token",
     *                 type="string"
     *             ),
     *             @SWG\Property(
     *                 property="user",
     *                 ref="#/definitions/User"
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
    public function authorizeAndGetToken1c(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::validate($request->all()) && Auth::getLastAttempted()->hasRole('1c')) {
            return response()->json([
                'api_token' => Auth::getLastAttempted()->api_token,
                'user' => Auth::getLastAttempted()
            ]);
        }

        return response('Unauthorized.', 401);
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *     path="/auth",
     *     summary="Авторизация",
     *     tags={"Mobile"},
     *     description="Авторизация и получение api_token",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *          name="email",
     *          description="Логин (Код АЗС)",
     *          type="string",
     *          required=true,
     *          in="query"
     *      ),
     *     @SWG\Parameter(
     *          name="password",
     *          description="Пароль",
     *          type="string",
     *          required=true,
     *          in="query"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="успешная авторизация",
     *         @SWG\Schema(
     *             type="object",
     *             @SWG\Property(
     *                 property="api_token",
     *                 type="string"
     *             ),
     *             @SWG\Property(
     *                 property="user",
     *                 ref="#/definitions/User"
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
    public function authorizeAndGetToken(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::validate($request->all()) && Auth::getLastAttempted()->hasRole('azs')) {
            return response()->json([
                'api_token' => Auth::getLastAttempted()->api_token,
                'user' => Auth::getLastAttempted(),
            ]);
        }

        return response('Unauthorized.', 401);
    }
}
