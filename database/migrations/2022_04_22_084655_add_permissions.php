<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class AddPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permission = Permission::findOrCreate('admin_per');
        Role::whereName('admin')->first()->givePermissionTo($permission);
        Role::whereName('manager')->first()->givePermissionTo($permission);
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Permission::whereName('admin_per')->delete();
        //
    }
}
