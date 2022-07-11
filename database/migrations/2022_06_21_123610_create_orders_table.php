<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class CreateOrdersTable extends Migration
{
    private array $permissions = [
        'order@index',
        'order@create',
        'order@show',
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [];

        foreach ($this->permissions as $permission){
            $permissions[] = Permission::findOrCreate($permission);
        }

        \Spatie\Permission\Models\Role::findByName('admin')->givePermissionTo($permissions);
        \Spatie\Permission\Models\Role::findByName('manager')->givePermissionTo($permissions);

        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('name');
            $table->double('total_price');
            $table->string('status')->default(\App\Models\Order::STATUS_CONSIDERATION);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('description');
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->timestamp('considered_at')->nullable();

            $table->timestamps();
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->uuid('order_uuid');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('count');
            $table->unsignedDouble('price');
        });


    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Spatie\Permission\Models\Permission::whereIn('name', $this->permissions)->delete();
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_product');
    }

}
