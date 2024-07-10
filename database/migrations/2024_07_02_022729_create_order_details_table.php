<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained('orders', 'order_id');
            $table->foreignId('product_id')->constrained('products', 'product_id');
            $table->primary(['order_id', 'product_id']);
            $table->integer('quantity');
            $table->double('total');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        DB::statement('
            CREATE TRIGGER `calculate_total` BEFORE INSERT ON `order_details` 
            FOR EACH ROW 
            BEGIN
                SET NEW.total = NEW.quantity * (SELECT product_price FROM products WHERE product_id = NEW.product_id);
            END;
        ');

        DB::statement('
            CREATE TRIGGER `calculate_total_amount` AFTER INSERT ON `order_details` 
            FOR EACH ROW 
            BEGIN
                UPDATE orders
                SET order_total = (
                    SELECT SUM(total)
                    FROM order_details
                    WHERE order_id = NEW.order_id
                )
                WHERE order_id = NEW.order_id;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP TRIGGER IF EXISTS calculate_total;');
        DB::statement('DROP TRIGGER IF EXISTS calculate_total_amount;');
        Schema::dropIfExists('order_details');
    }
};
