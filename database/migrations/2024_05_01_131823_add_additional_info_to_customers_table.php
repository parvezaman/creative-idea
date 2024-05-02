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
        Schema::table('customers', function (Blueprint $table) {
            Schema::table('customers', function (Blueprint $table) {
                $table->date('date_of_birth')->nullable();
                $table->string('customer_address')->nullable();
                $table->string('company_name')->nullable();
                $table->string('company_address')->nullable();
                $table->string('mobile')->nullable();
                $table->string('phone')->nullable();
                $table->string('website')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            //
        });
    }
};
