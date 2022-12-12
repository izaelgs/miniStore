<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    private $user;


    public function index() {

        try {
            $order = auth('api')->user()->orders()->paginate('10');

            return response()->json($order, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }
    }

    public function show($id) {

        try {
            $order = auth('api')->user()->orders()->findOrFail($id);

            return response()->json($order, 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }

    }

    public function store(OrderRequest $request) {

        $data = $request->all();
        $data['user_id'] = auth('api')->user()->id;
        $data['date'] = date('Y-m-d');

        try {

            $items = [];

            foreach ($data['items'] as $item) {
                $items[] = Product::find($item);
            }

            $order = Order::create($data);

            foreach ($items as $item) {
                $item['order_id'] = $order->id;
                $item['product_id'] = $item->id;
                $item['id'] = null;
                Item::create($item);
            }
            // $order->categories()->sync($data['items']);


            return response()->json([
                "message" => __('messages.createAddress'),
                "data" => $items
            ], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }
    }

    public function update($id, OrderRequest $request) {
        $data = $request->all();
        $data['user_id'] = auth('api')->user()->id;

        try {

            $order = auth('api')->user()->orders()->findOrFail($id);
            $order->update($data);

            return response()->json(['message' => __('messages.updateAddress')], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }
    }

    public function destroy($id) {

        try {

            $order = auth('api')->user()->orders()->findOrFail($id);
            $order->delete();

            return response()->json(['message' => __('messages.deleteAddress')], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }
    }
}
