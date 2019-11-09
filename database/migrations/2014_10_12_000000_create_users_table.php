<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('email_secondary')->unique()->nullable();
            $table->string('cpf')->unique();
            $table->string('cel')->unique();
            $table->string('address')->nullable();
            $table->timestamp('cpf_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('cel_verified_at')->nullable();
            $table->string('password');
            $table->enum('status', ['admin', 'user', 'collaborator'])->default('user');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
