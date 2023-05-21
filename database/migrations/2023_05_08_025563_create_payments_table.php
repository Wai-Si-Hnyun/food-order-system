<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('order_code');
            $table->decimal('payment_amount', 20, 2);
            $table->string('payment_currency');
            $table->string('payment_method');
            $table->string('payment_gateway');
            $table->string('payment_status');
            $table->string('transaction_id');
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('order_code')
                ->references('order_code')
                ->on('orders')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
