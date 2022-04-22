<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Premissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permission = Permission::create(['admin' => 'admin_pre']);
        Role::whereName('admin')->first()->givePermissionTo($permission);
        $permission = Permission::create(['manager' => 'manager_pre']);
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
        Permission::whereIn('name', ['user', 'admin', 'manager'])->delete();
        //
    }
}
