public function up(): void
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('sku')->unique();
        $table->string('barcode')->nullable();
        $table->decimal('price',10,2);
        $table->decimal('cost',10,2)->default(0);
        $table->integer('stock')->default(0);
        $table->string('category')->nullable();
        $table->boolean('status')->default(true);
        $table->timestamps();
    });
}