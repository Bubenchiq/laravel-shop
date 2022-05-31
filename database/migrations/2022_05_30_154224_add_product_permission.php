<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AddProductPermission extends Migration

{   /*@var array|string[] */
    private array $permissions = [
    'products@index',
    'products@create',
    'products@show',
    'products@edit',
    'products@delete',

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
        \Spatie\Permission\Models\Role::whereIn('name', $this->permissions)->delete();
    }
}
