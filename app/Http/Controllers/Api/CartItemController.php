<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $cart = auth('api')->user()->cartItems()->paginate('10');

            return response()->json(CartItemResource::collection($cart), 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        try {

            $product = Product::findOrFail($data['product_id']);

            $item = [];
            $item['user_id'] = auth('api')->user()->id;
            $item['product_id'] = $product->id;
            $item['price'] = $data['quantity'] * $product->price;
            $item['quantity'] = $data['quantity'];
            $item['date'] = date("Y-m-d");

            $cartItem = CartItem::create($item);

            // $order->categories()->sync($data['items']);

            return response()->json([
                "message" => __('messages.addCartItem'),
                "data" => new CartItemResource($cartItem)
            ], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $cart = auth('api')->user()->cartItems()->findOrFail($id);

            return response()->json($cart, 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
            // $message = new ApiMessages($e->getMessage());
            // return response()->json($message->getMessage(), 401);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cart = auth('api')->user()->cartItems()->findOrFail($id);
            $cart->delete();

            return response()->json([
                'message' => __('messages.removeCartItem')
            ], 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
    }
}
