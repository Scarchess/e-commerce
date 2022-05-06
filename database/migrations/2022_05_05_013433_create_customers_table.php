<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('organisation');
            $table->string('gender', 100)->nullable(true);
            $table->string('name', 250)->nullable(false);
            $table->string('email', 250)->unique();
            $table->string('login_name', 250)->nullable(false);
            $table->string('password', 250);
            $table->string('phone', 100);
            $table->string('streetAdress', 250);
            $table->integer('addressNumber', 250);
            $table->string('district', 250);
            $table->string('city', 250);
            $table->string('state', 250);
            $table->string('country', 250);
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
        Schema::dropIfExists('customers');
    }
}
