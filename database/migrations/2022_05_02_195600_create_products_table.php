<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('subcategory_id');
            $table->string('name', 250)->nullable(false);
            $table->string('color', 250)->nullable(false);
            $table->text('description', 1000)->nullable(true);
            $table->string('size', 20)->nullable(false);
            $table->float('price', 12,2)->nullable(true);
            $table->string('isbn', 100)->nullable(true);
            $table->string('codebar', 100)->nullable(true);
            $table->float('weight', 12,3)->nullable(true);
            $table->float('width', 12,3)->nullable(true);
            $table->float('height', 12,2)->nullable(true);
            $table->float('depth', 12,3)->nullable(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('subcategory_id')->references('id')->on('subcategories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
