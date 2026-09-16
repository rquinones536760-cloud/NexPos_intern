<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales', function (Blueprint $table) {

            if (!Schema::hasColumn('sales', 'payment_reference')) {
                $table->string('payment_reference')
                    ->nullable()
                    ->after('payment_method');
            }

            if (!Schema::hasColumn('sales', 'payment_proof')) {
                $table->string('payment_proof')
                    ->nullable()
                    ->after('payment_reference');
            }
        });
    }

    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {

            if (Schema::hasColumn('sales', 'payment_proof')) {
                $table->dropColumn('payment_proof');
            }

            if (Schema::hasColumn('sales', 'payment_reference')) {
                $table->dropColumn('payment_reference');
            }
        });
    }
};