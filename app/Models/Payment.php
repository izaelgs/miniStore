<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Payment extends Model
{
    use HasFactory;

    function __construct( $attributes = array())
    {
        $this->value = $attributes['value'];
        $this->encrypted = $attributes['encrypted'];
    }

    public function creditCardPayment() {
        $response = Http::withHeaders([
            'Authorization' => 'A1439A7003214EBEB47F6A664AA4045E',
            'Content-Type' => 'application/json'
        ])->post('https://sandbox.api.pagseguro.com/charges', [
            "reference_id" => "ORDE_EF4448C8-EFE6-40C2-83A1-6847E53C44AC",
            "description" => "Compra efetuada",
            "amount" => [
                "value" => $this->value,
                "currency" => "BRL"
            ],
            "payment_method" => [
                "type" => "CREDIT_CARD",
                "installments" => 1,
                "capture" => true,
                "card" => [
                    "encrypted" => $this->encrypted
                ]
            ]
        ]);

        if($response->status() == 201)
            return response()->json($response->json(), 200);
        else {
            // $data = $response->object()->error_messages;
            throw new Exception($response->body() . $response->status());
        }

    }
}
