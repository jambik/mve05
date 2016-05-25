<?php

namespace App\Http\Controllers\Api;

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
     *     path="/auth",
     *     summary="Запрос на авторизацию",
     *     tags={"Авторизация"},
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
     *      ),
     * )
     */
    public function authorizeAndGetToken(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->all())) {
            return response()->json(['api_token' => Auth::user()->api_token, 'user' => Auth::user()]);
        }

        return response('Unauthorized.', 401);
    }
}
