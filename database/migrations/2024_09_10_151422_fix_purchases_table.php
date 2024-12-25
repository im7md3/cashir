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
        Schema::table('purchases', function (Blueprint $table) {
            $table->foreignId('supplier_id')->after('id')->nullable()->constrained()->cascadeOnDelete();
            $table->double('tax')->after('amount')->nullable()->default(0);
            $table->double('total')->after('tax')->nullable()->default(0);
            $table->date('date')->after('supplier_id')->nullable();
            $table->dropColumn(['name', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropConstrainedForeignId('supplier_id');
            $table->dropColumn(['tax', 'total', 'date']);
        });
    }
};
