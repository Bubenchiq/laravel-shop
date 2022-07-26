<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignRoleMigration extends Migration
{
    /*@var array|string[] */
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $role = Role::whereName('manager')->first();
        $role->givePermissionTo(Permission::findOrCreate('manager_per'));
        $role->revokePermissionTo(Permission::findOrCreate('admin_per'));
        Role::whereName('admin')->first()->givePermissionTo(Permission::findOrCreate('admin_per'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $role = Role::whereName('manager')->first();
        Permission::whereName('manager_per')->delete();
        Permission::whereName('admin_per')->delete();
        $role->givePermissionTo(Permission::findOrCreate('admin_per'));

        //
    }
}
