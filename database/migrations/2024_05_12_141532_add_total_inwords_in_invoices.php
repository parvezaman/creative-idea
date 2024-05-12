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
            $table->string('total_in_words')->nullable()->after('in_words')->comment('total amount of the whole invoice in words.');
            $table->boolean('is_paid')->nullable()->after('total_in_words')->comment('true if paid false if not paid');
            $table->enum('payment_method', ['Cash', 'Cheque', 'Credit Card', 'Bank Transfer', 'PayPal', 'Other'])->nullable()->after('is_paid')->comment('Stores the payment method used for the invoice.');
            $table->string('reference')->nullable()->after('payment_method')->comment('helpful reference like cheque number etc');
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
