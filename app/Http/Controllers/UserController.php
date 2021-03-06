<?php
namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
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
        $user = app(UserService::class)->create($input);
        $success['token'] = $user->createToken('Hostaway')->accessToken;
        $success['name'] = $user->name;

        return response()->json(['success' => $success]);
    }
}