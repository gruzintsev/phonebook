<?php
namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * @param UserRegisterRequest $request
     * @return JsonResponse
     */
    public function register(UserRegisterRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('Hostaway')->accessToken;
        $success['name'] = $user->name;

        return response()->json(['success' => $success]);
    }
}