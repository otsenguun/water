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
            $table->integer("c_user")->default(0);
            $table->integer("d_user")->default(0);
            $table->date("d_date")->nullable();
            $table->integer("index")->default(0);
            $table->integer("order_id")->default(0);
            $table->integer("phone")->default(0);
            $table->integer("duureg")->defalut(0);
            $table->string("address")->nullable();
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
