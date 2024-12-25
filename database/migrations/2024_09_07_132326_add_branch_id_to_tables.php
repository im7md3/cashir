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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('user_sessions', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('suppliers', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('reservations', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('purchases', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('payment_methods', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('packages', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('offers', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('expense_categories', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('expenses', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('departments', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('branch_id');
        });
        Schema::table('user_sessions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('branch_id');
        });
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('branch_id');
        });
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('branch_id');
        });
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropConstrainedForeignId('branch_id');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropConstrainedForeignId('branch_id');
        });
        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('branch_id');
        });
        Schema::table('payment_methods', function (Blueprint $table) {
            $table->dropConstrainedForeignId('branch_id');
        });
        Schema::table('packages', function (Blueprint $table) {
            $table->dropConstrainedForeignId('branch_id');
        });
        Schema::table('offers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('branch_id');
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropConstrainedForeignId('branch_id');
        });
        Schema::table('expense_categories', function (Blueprint $table) {
            $table->dropConstrainedForeignId('branch_id');
        });
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropConstrainedForeignId('branch_id');
        });
        Schema::table('departments', function (Blueprint $table) {
            $table->dropConstrainedForeignId('branch_id');
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->dropConstrainedForeignId('branch_id');
        });
    }
};
