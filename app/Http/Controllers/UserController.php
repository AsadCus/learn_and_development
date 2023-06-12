<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAllUserApi()
    {
        return response()->JSON(['status'=>200,'message' => 'success', 'data' => $this->userService->handleGetAllUser()], 200);
    }

    public function getHierarchyApi(Request $request)
    {
        return response()->JSON($this->userService->handleGetHierarchy($request),200);
    }
}
