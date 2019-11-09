<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reference');
            $table->double('value', 6,2);
            $table->enum('status', ['AWAITING_PAYMENT', 'AUTHORIZED', 'DECLINED', 'FAILED', 'NOT_AUTHORIZED', 'CONFIRMED', 'CANCELED'])->nullable();
            $table->text('description');
            $table->dateTime('due_date');
            $table->unsignedBigInteger('comunity_id');
            $table->foreign('comunity_id')->references('id')->on('comunities');
            $table->json('payments_details')->nullable();
            $table->string('payment_Token')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
