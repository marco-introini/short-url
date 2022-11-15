<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\BaseApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Validator;

use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class RegisterController extends Controller
{
    use BaseApiResponse;

    /**
     * Register a new user
     *
     * This API call register a new user for Short-Url
     */
    #[OpenApi\Operation]
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required','email',Rule::unique('users','email')],
            'password' => ['required','confirmed'],
        ]);

        if ($validator->fails()) {
            return $this->sendErrorResponse( $validator->errors()->toArray(),"Validation error",401);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);

        $success['token'] = $user->createToken('Token for user '.$user->name)->plainTextToken;
        $success['name'] = $user->name;
        $success['email'] = $user->email;
        $success['created_at'] = $user->created_at;

        return $this->sendSuccessResponse($success, 'User registered successfully.');
    }

    /**
     * Login
     *
     * User login function. It returns the Bearer Token
     */
    #[OpenApi\Operation]
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('Token for user '.$user->name)->plainTextToken;
            $success['name'] = $user->name;

            return $this->sendSuccessResponse($success, 'User login successfully.');
        } else {
            return $this->sendErrorResponse( ['error' => 'Unauthorized'], 'User unauthorized', 403);
        }
    }
}