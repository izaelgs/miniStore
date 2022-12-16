<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained();
            $table->foreignId('address_id')
                ->constrained();

            $table->decimal('total_price', 20, 2);

            $table->dateTime('date');

                /* tinyInteger Status
                * 0 - cancelado
                * 1 - analise
                * 2 - pendente
                * 3 - confirmado
                * 4 - em trânsito
                * 5 - entregue
                * 6 - em devolução
                */
            $table->tinyInteger('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
