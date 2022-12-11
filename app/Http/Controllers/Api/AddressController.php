<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    private $user;


    public function index() {

        try {
            $address = auth('api')->user()->adresses()->paginate('10');

            return response()->json($address, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }
    }

    public function show($id) {

        try {
            $address = auth('api')->user()->adresses()->findOrFail($id);

            return response()->json($address, 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }

    }

    public function store(AddressRequest $request) {

        $data = $request->all();
        $data['user_id'] = auth('api')->user()->id;

        try {

            $address = Address::create($data);

            return response()->json([
                "message" => __('messages.createAddress'),
                "data" => $address
            ], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }
    }

    public function update($id, AddressRequest $request) {
        $data = $request->all();
        $data['user_id'] = auth('api')->user()->id;

        try {

            $address = auth('api')->user()->adresses()->findOrFail($id);
            $address->update($data);

            return response()->json(['message' => __('messages.updateAddress')], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }
    }

    public function destroy($id) {

        try {

            $address = auth('api')->user()->adresses()->findOrFail($id);
            $address->delete();

            return response()->json(['message' => __('messages.deleteAddress')], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }
    }
}
