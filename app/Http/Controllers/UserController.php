<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Imports\UserImport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\View\View;
use Maatwebsite\Excel\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UserController extends Controller
{
    public function __construct(private UserService $service)
    {
    }

    public function index(): View
    {
        return view("users.index");
    }

    public function list(Request $request): JsonResponse
    {
        try {
            $data = $this->service->list($request->all());
            return response()->json(['data' => $data]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Failed to fetching users",
                'log' => $e->getMessage()
            ], 400);
        }
    }

    public function create(CreateRequest $request): JsonResponse
    {
        try {
            $data = $this->service->create($request->all());
            return response()->json([
                'data' => $data,
                'message' => "User created with successfull!"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Failed to create user",
                'log' => $e->getMessage()
            ], 400);
        }
    }

    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        try {
            $data = $this->service->update($request->all(), $id);
            return response()->json([
                'data' => $data,
                'message' => "User updated with successfull!"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Failed to update user",
                'log' => $e->getMessage()
            ], 400);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $data = $this->service->destroy($id);
            return response()->json([
                'data' => $data,
                'message' => "User removed with successfull!"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Failed to remove user",
                'log' => $e->getMessage()
            ], 400);
        }
    }

    public function import(): JsonResponse
    {
        try {
            Excel::import(new UserImport(), 'users.xlsx');
            return response()->json([
                'message' => "Users file imported with sucessfull!"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Failed to import users",
                'log' => $e->getMessage()
            ], 400);
        }
    }

    public function export(Request $request): BinaryFileResponse|JsonResponse
    {
        try {
            return Excel::download(new UserExport(), 'users.xlsx');
        } catch (Exception $e) {
            return response()->json([
                'message' => "Failed to export users",
                'log' => $e->getMessage()
            ], 400);
        }
    }
}
