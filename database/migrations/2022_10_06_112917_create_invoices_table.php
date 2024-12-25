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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users','id')->cascadeOnDelete();
            $table->foreignId('client_id')->nullable()->constrained('clients','id')->nullOnDelete();
            $table->date('date');
            $table->double('price')->default(0)->nullable();
            $table->double('discount')->default(0)->nullable();
            $table->double('tax')->default(0)->nullable();
            $table->double('total')->default(0)->nullable();
            $table->string('payment_method')->default('card');
            $table->string('status')->default('paid');
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
};
