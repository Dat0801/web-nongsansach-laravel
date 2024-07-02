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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->foreignId('employee_id')->constrained('employees', 'employee_id');
            $table->date('ship_date')->nullable();
            $table->double('order_total')->nullable();
            $table->string('status')->default('Đang xử lý');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        DB::unprepared('
            CREATE TRIGGER before_insert_orders
            BEFORE INSERT ON orders
            FOR EACH ROW
            BEGIN
                IF NEW.ship_date IS NULL THEN
                    SET NEW.ship_date = CURDATE() + INTERVAL 1 DAY;
                END IF;
            END;
        ');

        DB::statement('
            CREATE TRIGGER `update_product_stock` AFTER UPDATE ON `orders` FOR EACH ROW BEGIN
                IF NEW.status = \'Đang giao hàng\' THEN
                    UPDATE products
                    INNER JOIN order_details ON products.product_id = order_details.product_id
                    SET products.product_stock = products.product_stock - order_details.quantity
                    WHERE order_details.order_id = NEW.order_id;
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP TRIGGER IF EXISTS update_product_stock;');
        Schema::dropIfExists('orders');
    }
};
