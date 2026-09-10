<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('sales', 'invoice_no')) {
            Schema::table('sales', function (Blueprint $table) {
                $table->string('invoice_no')
                    ->nullable()
                    ->unique()
                    ->after('customer_id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('sales', 'invoice_no')) {
            Schema::table('sales', function (Blueprint $table) {
                $table->dropColumn('invoice_no');
            });
        }
    }
};