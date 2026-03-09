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
        Schema::create('sell_products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')->nullable()->constrained('products')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('sell_id')->nullable()->constrained('sells')->cascadeOnUpdate()->nullOnDelete();

            $table->date('sell_day')->nullable();
            $table->string('fullname_customer')->nullable();
            $table->integer('number_sell')->nullable();
            $table->integer('price_sell')->nullable();
            $table->integer('revenue')->nullable();

            $table->foreignId('atm_id')->nullable()->constrained('atms')->cascadeOnUpdate()->nullOnDelete();

            $table->integer('number_products')->nullable();
            $table->unsignedTinyInteger('bagging')->default(0)->comment('0: chưa đóng bao, 1: đã đóng bao');
            $table->integer('number_bagging')->nullable();

            $table->integer('transport')->nullable();
            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sell_products');
    }
};
