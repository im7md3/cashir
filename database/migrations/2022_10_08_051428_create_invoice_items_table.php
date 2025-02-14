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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices','id')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products','id')->cascadeOnDelete();
            $table->foreignId('department_id')->constrained('departments','id')->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('unit')->nullable();
            $table->string('code')->nullable();
            $table->string('department_name')->nullable();
            $table->double('quantity')->nullable();
            $table->double('price')->nullable();
            $table->double('total')->nullable();
            $table->double('tax')->nullable();
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
        Schema::dropIfExists('invoice_items');
    }
};
