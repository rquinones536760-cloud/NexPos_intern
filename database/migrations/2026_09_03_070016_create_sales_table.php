public function up(): void
{
    Schema::create('sales', function (Blueprint $table) {
        $table->id();

        $table->foreignId('customer_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        $table->string('invoice_no')->unique();

        $table->decimal('subtotal',10,2)->default(0);
        $table->decimal('discount',10,2)->default(0);
        $table->decimal('tax',10,2)->default(0);
        $table->decimal('total',10,2)->default(0);

        $table->decimal('paid',10,2)->default(0);
        $table->decimal('change',10,2)->default(0);

        $table->timestamps();
    });
}