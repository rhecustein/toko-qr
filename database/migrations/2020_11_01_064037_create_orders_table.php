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
            $table->unsignedInteger('user_id')->nullable()->comment('which customer created this order');
            $table->unsignedInteger('table_id')->nullable();
            $table->string('name');
            $table->string('phone_number')->nullable();
            $table->unsignedInteger('restaurant_id');
            $table->string('transaction_id')->nullable();
            $table->string('time')->nullable();
            $table->double('total_price')->default(0);
            $table->enum('status',['pending','approved','ready_for_delivery','delivered','rejected'])->default('pending');
            $table->enum('type',['pay_on_table','pay_now','takeaway','delivery'])->default('pay_on_table');
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            $table->string('delivered_within')->nullable()->comment("format 5_minutes");
            $table->string('comment')->nullable()->comment("Customer will specify if they need anything extra");
            $table->timestamp('approved_at')->nullable();
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
