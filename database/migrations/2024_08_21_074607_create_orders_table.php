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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('shipping_address_id')->constrained('shipping_addresses')->onDelete('cascade');
            $table->string('payment_method');
            $table->decimal('subtotal', 8,2);
            $table->decimal('shipping',8,2);
            $table->decimal('total',8,2);
            $table->enum('status', ['Pending', 'Processing', 'Delivered'])->default('Pending');
            $table->string('order_id')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
