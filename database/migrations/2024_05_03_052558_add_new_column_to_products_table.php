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
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('vat', 8, 2)->default(0)->after('price');
            $table->decimal('tax', 8, 2)->default(0)->after('vat');
            $table->integer('warranty')->unsigned()->nullable()->after('tax');
            $table->integer('stock')->unsigned()->default(0)->after('tax');
            $table->renameColumn('price', 'purchase_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
