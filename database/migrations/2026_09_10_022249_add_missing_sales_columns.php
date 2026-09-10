<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales', function (Blueprint $table) {

            if (!Schema::hasColumn('sales', 'invoice_no')) {
                $table->string('invoice_no')
                    ->nullable()
                    ->unique()
                    ->after('customer_id');
            }

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

            if (!Schema::hasColumn('sales', 'subtotal')) {
                $table->decimal('subtotal', 10, 2)
                    ->default(0)
                    ->after('status');
            }

            if (!Schema::hasColumn('sales', 'discount')) {
                $table->decimal('discount', 10, 2)
                    ->default(0)
                    ->after('subtotal');
            }

            if (!Schema::hasColumn('sales', 'tax')) {
                $table->decimal('tax', 10, 2)
                    ->default(0)
                    ->after('discount');
            }

            if (!Schema::hasColumn('sales', 'total')) {
                $table->decimal('total', 10, 2)
                    ->default(0)
                    ->after('tax');
            }

            if (!Schema::hasColumn('sales', 'paid')) {
                $table->decimal('paid', 10, 2)
                    ->default(0)
                    ->after('total');
            }

            if (!Schema::hasColumn('sales', 'change')) {
                $table->decimal('change', 10, 2)
                    ->default(0)
                    ->after('paid');
            }
        });
    }

    public function down(): void
    {
        $columns = [
            'invoice_no',
            'payment_method',
            'status',
            'subtotal',
            'discount',
            'tax',
            'total',
            'paid',
            'change',
        ];

        $existingColumns = array_filter(
            $columns,
            fn ($column) => Schema::hasColumn('sales', $column)
        );

        if (!empty($existingColumns)) {
            Schema::table('sales', function (Blueprint $table) use ($existingColumns) {
                $table->dropColumn($existingColumns);
            });
        }
    }
};