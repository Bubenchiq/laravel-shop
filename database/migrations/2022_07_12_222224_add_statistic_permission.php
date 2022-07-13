<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class AddStatisticPermission extends Migration
{
    private array $permissions = [
        'statistic@index',
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
            $permissions[] = Permission::create(['name'=> $permission]);
        }

        \Spatie\Permission\Models\Role::findByName('admin')->givePermissionTo($permissions);
        \Spatie\Permission\Models\Role::findByName('manager')->givePermissionTo($permissions);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Spatie\Permission\Models\Permission::whereIn('name', $this->permissions)->delete();
    }
}
