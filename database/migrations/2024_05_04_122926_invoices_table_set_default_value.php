<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Set default values for each not null column
            $table->string('invoice_number')->default('Creative-Idea-INV-')->change();
            $table->string('subject')->default('Sell')->change();
            $table->unsignedBigInteger('customer_id')->default(0)->change();
            $table->unsignedBigInteger('product_id')->default(0)->change();
            $table->integer('quantity')->default(0)->change();
            $table->decimal('purchase_price', 10, 2)->default(0.00)->change();
            $table->decimal('vat', 10, 2)->default(0.00)->change();
            $table->decimal('tax', 10, 2)->default(0.00)->change();
            $table->string('warranty')->nullable()->default(null)->change(); // Nullable column
            $table->decimal('total_amount', 10, 2)->default(0.00)->change();
            $table->string('in_words')->default('')->change();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            //
        });
    }
};
