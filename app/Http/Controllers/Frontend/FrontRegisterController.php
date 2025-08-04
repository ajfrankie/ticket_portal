<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Repositories\RegisterRepository;
use App\Http\Requests\StoreRegisterRequest;

class FrontRegisterController extends Controller
{
    protected $registerRepository;

    public function __construct(RegisterRepository $registerRepository)
    {
        $this->registerRepository = $registerRepository;
    }

    public function register(StoreRegisterRequest $request)
    {
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
