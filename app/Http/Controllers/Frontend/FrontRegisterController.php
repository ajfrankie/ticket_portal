<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\RegisterRepository;
use Illuminate\Support\Facades\Validator;

class FrontRegisterController extends Controller
{
    protected $registerRepository;

    public function __construct(RegisterRepository $registerRepository)
    {
        $this->registerRepository = $registerRepository;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', 
            'dob'      => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $input = $request->only(['name', 'email', 'dob']);
        $input['password'] = Hash::make($request->password);
        $input['role'] = 'customer'; 

        $user = $this->registerRepository->create($input);

        return response()->json([
            'status' => true,
            'message' => 'Customer registered successfully.',
            'user' => $user,
        ], 201);
    }
}