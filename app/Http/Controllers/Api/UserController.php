<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index() {

        try {
            $user = $this->user->paginate('10');

            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }
    }

    public function show($id) {

        try {
            $user = $this->user->findOrFail($id);

            return response()->json($user, 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }

    }

    public function store(UserRequest $request) {

        $data = $request->all();

        try {

            $data['password'] = bcrypt($data['password']);
            $user = $this->user->create($data);

            return response()->json(['message' => __('messages.createUser')], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }
    }

    public function update($id, UserRequest $request) {
        $data = $request->all();

        if($request->has('password') && $request->get('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        try {

            $user = $this->user->findOrFail($id);
            $user->update($data);

            return response()->json([
                'data' => [
                    'msg' => __('messages.updateUser')
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }
    }

    public function destroy($id) {

        try {

            $user = $this->user->findOrFail($id);
            $user->delete();

            return response()->json(['message' => __('messages.deleteUser')], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }
    }
}
