<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_details', function (Blueprint $table) {
            $table->id();
            $table->string('order_code');
            $table->string('name');
            $table->string('country', 50);
            $table->string('state', 50);
            $table->string('city', 50);
            $table->string('address');
            $table->string('phone', 15);
            $table->longText('note')->nullable();
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
        Schema::dropIfExists('billing_details');
    }
}
