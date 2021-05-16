<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    /**
     * Register api
     *
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'access_token' => 'required',
        ]);

        $client = new Client(['verify' => 'C:\Program Files (x86)\php\extras\ssl\cacert.pem']); /*local only*/
//        $client = new Client();

        $response = $client->get('https://graph.microsoft.com/v1.0/me', [
            'headers' => [
                'Authorization' => 'Bearer '.$request->access_token,
            ]
        ]);

        if($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody()->getContents());
            $user = User::where('email', '=', $data->mail)->first();

            if($user) {
                $user->token = $user->createToken('Uznemsana')->accessToken;
                $success = new UserResource($user);
                return $this->sendResponse($success, 'User login successfully.');
            } else {
                return $this->sendError('Jūsu lietotājs netika atrasts sistēmā.', ['error' => 'Unauthorised']);
            }
        }

        return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    }

    public function me(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->token = null;

        return $this->sendResponse(new UserResource($user), 'You are authenticated');
    }
}
