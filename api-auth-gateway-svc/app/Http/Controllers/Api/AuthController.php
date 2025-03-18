<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Traits\ResponseAPI;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    use ResponseAPI;
    public function register(RegisterRequest $request){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $response = json_decode(Http::post("http://127.0.0.1:8001/api/user", $data)->json());
            if(!$response->success){
                DB::rollBack();
                return $this->sendErrorResponse(501, null, $response->message, $data);
            }
            $token = $response->createToken('auth_token')->accessToken;
            DB::commit();

            event(new Registered($response));

            $data = [
                "user" => [
                    "name" => $data["name"],
                    "email" => $data["email"],
                ],
                "token" => $token,
                "token_type" => "Bearer",
            ];
            return $this->sendSuccessResponse(200, null, $response->message, $data);
        }catch (\Exception $e){
            DB::rollBack();
        }
    }
}
