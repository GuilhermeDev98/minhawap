<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCancellationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancellation_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reason');
            $table->text('note')->nullable();
            $table->boolean('withheld');
            $table->unsignedBigInteger('comunity_id');
            $table->foreign('comunity_id')->references('id')->on('comunities');
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
        Schema::dropIfExists('cancellation_requests');
    }
}
