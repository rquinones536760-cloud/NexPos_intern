<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            if (!Schema::hasColumn('products', 'cost')) {
                $table->decimal('cost', 10, 2)
                    ->default(0)
                    ->after('price');
            }

            if (!Schema::hasColumn('products', 'unit')) {
                $table->string('unit')
                    ->default('piece')
                    ->after('category');
            }

            if (!Schema::hasColumn('products', 'low_stock_limit')) {
                $table->integer('low_stock_limit')
                    ->default(5)
                    ->after('stock');
            }

            if (!Schema::hasColumn('products', 'description')) {
                $table->text('description')
                    ->nullable()
                    ->after('unit');
            }

        });
    }

    public function down(): void
    {
        $columns = [];

        if (Schema::hasColumn('products', 'cost')) {
            $columns[] = 'cost';
        }

        if (Schema::hasColumn('products', 'unit')) {
            $columns[] = 'unit';
        }

        if (Schema::hasColumn('products', 'low_stock_limit')) {
            $columns[] = 'low_stock_limit';
        }

        if (Schema::hasColumn('products', 'description')) {
            $columns[] = 'description';
        }

        if (!empty($columns)) {
            Schema::table('products', function (Blueprint $table) use ($columns) {
                $table->dropColumn($columns);
            });
        }
    }
};