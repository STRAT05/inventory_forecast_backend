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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Product name
            $table->text('description')->nullable(); // Product description
            $table->decimal('price', 8, 2); // Price with 2 decimal places
            $table->integer('stock')->default(0); // Stock quantity
            $table->integer('purchases')->default(0); // Number of purchases
            $table->string('image')->nullable(); // Image path
            $table->float('average_weekly_sales')->nullable(); // Average weekly sales  
            $table->integer('lead_time')->nullable(); // days need to replenish stock
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
