<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            if (Schema::hasColumn('offers', 'product_id')) {
                $table->dropConstrainedForeignId('product_id');
            }
        });
        Schema::table('offers', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->constrained('products')->cascadeOnDelete();
            $table->enum('type', ['all', 'product'])->default('product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            //
        });
    }
};
