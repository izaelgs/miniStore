<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Address;
use App\Models\CartItem;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    private $user;


    public function index()
    {

        try {
            $order = auth('api')->user()->orders()->paginate('10');

            return response()->json($order, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }
    }

    public function show($id)
    {

        try {
            $order = new OrderResource(
                auth('api')->user()->orders()->with('items')->findOrFail($id)
            );

            return response()->json($order, 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }

    }

    public function store(OrderRequest $request)
    {

        $data = $request->all();
        $data['user_id'] = auth('api')->user()->id;
        $data['date'] = date('Y-m-d');

        try {

            // Verifica existência de itens no carrinho
            $cart = auth('api')->user()->cartItems()->get();
            if($cart->isEmpty()) return response()->json(["message" => "Não foi possível encontrar nenhum item no carrinho"], 401);

            $data['total_price'] = $cart->sum('price') * 100;

            $order = Order::create($data);

            foreach ($cart as $cartItem) {
                $item = [];
                $item['order_id'] = $order->id;
                $item['product_id'] = $cartItem->product_id;
                $item['price'] = $cartItem->price;
                $item['quantity'] = $cartItem->quantity;
                $item['date'] = $data['date'];

                Item::create($item);
            }

            $address = Address::findOrFail($data['address_id']);

            $details = OrderDetail::create([
                'order_id' => $order->id,
                'phone' => $data['phone'],
                'street' => $address->street,
                'number' => $address->number,
                'city' => $address->city,
                'state' => $address->state,
                'zipcode' => $address->zipcode,
                'complement' => $address->complement,
            ]);

            $payment = new Payment([
                "value" => $order->total_price,
                "encrypted" => $data['encrypted'],
            ]);

            $paymentResponse = $payment->creditCardPayment();
            // return response()->json($paymentResponse->json(), 200);

            CartItem::where('user_id', auth('api')->user()->id)->delete();

            return response()->json([
                "message" => __('messages.createAddress'),
                "data" => [
                    "order" => $order,
                    "details" => $details,
                    "payment" => $paymentResponse,
                ]
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
