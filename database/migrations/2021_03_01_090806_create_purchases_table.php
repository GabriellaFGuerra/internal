<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('project_id')->constrained();
            $table->double('unit_value', 10, 2);
            $table->integer('quantity');
            $table->double('total_value', 10, 2);
            $table->string('provider');
            $table->string('invoice_path');
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
        Schema::dropIfExists('purchases');
    }
}
