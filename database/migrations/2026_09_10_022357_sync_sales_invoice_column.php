<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (
            Schema::hasColumn('sales', 'invoice_number') &&
            Schema::hasColumn('sales', 'invoice_no')
        ) {
            // Copy invoice_no into the old required column.
            DB::statement('
                UPDATE sales
                SET invoice_number = invoice_no
                WHERE invoice_number IS NULL OR invoice_number = ""
            ');
        }

        elseif (Schema::hasColumn('sales', 'invoice_number')) {
            // Keep the existing invoice_number column.
            return;
        }

        elseif (Schema::hasColumn('sales', 'invoice_no')) {
            Schema::table('sales', function (Blueprint $table) {
                $table->renameColumn('invoice_no', 'invoice_number');
            });
        }
    }

    public function down(): void
    {
        if (
            Schema::hasColumn('sales', 'invoice_number') &&
            !Schema::hasColumn('sales', 'invoice_no')
        ) {
            Schema::table('sales', function (Blueprint $table) {
                $table->renameColumn('invoice_number', 'invoice_no');
            });
        }
    }
};