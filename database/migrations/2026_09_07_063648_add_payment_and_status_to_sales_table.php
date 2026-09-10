<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales', function (Blueprint $table) {

            if (!Schema::hasColumn('sales', 'payment_method')) {
                $table->string('payment_method')
                    ->default('cash')
                    ->after('invoice_no');
            }

            if (!Schema::hasColumn('sales', 'status')) {
                $table->string('status')
                    ->default('completed')
                    ->after('payment_method');
            }

        });
    }

    public function down(): void
    {
        $columns = [];

        if (Schema::hasColumn('sales', 'payment_method')) {
            $columns[] = 'payment_method';
        }

        if (Schema::hasColumn('sales', 'status')) {
            $columns[] = 'status';
        }

        if (!empty($columns)) {
            Schema::table('sales', function (Blueprint $table) use ($columns) {
                $table->dropColumn($columns);
            });
        }
    }
};