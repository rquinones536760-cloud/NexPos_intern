public function up(): void
{
    Schema::create('sale_items', function (Blueprint $table) {
        $table->id();

        $table->foreignId('sale_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('product_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->integer('qty');
        $table->decimal('price',10,2);
        $table->decimal('total',10,2);

        $table->timestamps();
    });
}