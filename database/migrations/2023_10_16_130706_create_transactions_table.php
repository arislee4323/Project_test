<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_t', function (Blueprint $table) {
            $table->id();
            $table->string('product')->nullable();
            $table->text('image')->nullable();
            $table->string('description')->nullable();
            $table->integer('qty')->nullable();
            $table->float('price')->nullable();
            $table->float('discount')->nullable();
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
        Schema::dropIfExists('transaction_t');
    }
};
