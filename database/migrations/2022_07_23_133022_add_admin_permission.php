<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;

class AddAdminPermission extends Migration
{
    private array $permissions = [
        'users@index',
        'users@create',
        'users@show',
        'users@edit',
        'users@delete',
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
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Permission::whereIn('name', $this->permissions)->delete();
    }
}
