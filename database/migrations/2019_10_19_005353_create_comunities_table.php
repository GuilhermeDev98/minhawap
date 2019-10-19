<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comunities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('link');
            $table->boolean('active')->default(0);
            $table->enum('status', ['WA', 'AF', 'AP', 'RD', 'SS', 'OA', 'SP', 'CC'])->default('WA');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('disk_space')->default('0'); // in mbs
            $table->string('sms')->default('0');
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
        Schema::dropIfExists('comunities');
    }
}
/** 
*-aguardando aprovação - WA
*-ativação reprovada - AF
*-aguardando pagamento - AP
*-registrando domínio - RD
*-enviando para o servidor - SS
*-no ar - OA
*-suspensa - SP
*-cancelada - CC
*/