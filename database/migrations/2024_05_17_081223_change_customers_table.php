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
            // $table->renameColumn('name', 'contact_person_name');
            // $table->renameColumn('email', 'contact_person_email');
            // $table->renameColumn('date_of_birth', 'contact_person_dob');
            $table->renameColumn('customer_address', 'contact_person_address');
            $table->renameColumn('mobile', 'contact_person_mobile');
            $table->renameColumn('phone', 'contact_person_phone');
            $table->renameColumn('website', 'contact_person_website');
            // $table->string('company_phone');
            // $table->string('company_website');
            // $table->string('company_email');
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



// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::table('customers', function (Blueprint $table) {
//             // Rename columns
//             $table->renameColumn('name', 'contact_person_name');
//             $table->renameColumn('email', 'contact_person_email');
//             $table->renameColumn('date_of_birth', 'contact_person_dob');
//             $table->renameColumn('customer_address', 'contact_person_address');
//             $table->renameColumn('mobile', 'contact_person_mobile');
//             $table->renameColumn('phone', 'contact_person_phone');
//             $table->renameColumn('website', 'contact_person_website');
//         });

//         Schema::table('customers', function (Blueprint $table) {
//             // Add new columns
//             $table->string('company_phone')->nullable()->after('contact_person_phone');
//             $table->string('company_website')->nullable()->after('contact_person_website');
//             $table->string('company_email')->nullable()->after('contact_person_email');

//             // Update existing date column to be nullable
//             $table->date('contact_person_dob')->nullable()->change();
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::table('customers', function (Blueprint $table) {
//             // Reverse the renaming of columns
//             $table->renameColumn('contact_person_name', 'name');
//             $table->renameColumn('contact_person_email', 'email');
//             $table->renameColumn('contact_person_dob', 'date_of_birth');
//             $table->renameColumn('contact_person_address', 'customer_address');
//             $table->renameColumn('contact_person_mobile', 'mobile');
//             $table->renameColumn('contact_person_phone', 'phone');
//             $table->renameColumn('contact_person_website', 'website');

//             // Drop newly added columns
//             $table->dropColumn('company_phone');
//             $table->dropColumn('company_website');
//             $table->dropColumn('company_email');

//             // Revert date column to not nullable if needed
//             $table->date('date_of_birth')->nullable(false)->change();
//         });
//     }
// };

