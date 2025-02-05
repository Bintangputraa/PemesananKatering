<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('history_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->references('id')->on('orders');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('nama');
            $table->string('no_telf');
            $table->string('alamat');
            $table->foreignId('menu_id')->references('id')->on('menus');
            $table->string('jumlah');
            $table->string('harga');
            $table->string('total');
            $table->string('tanggal');
            $table->string('metode_pembayaran');
            $table->foreignId('payment_id')->references('id')->on('payments');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_orders');
    }
};
