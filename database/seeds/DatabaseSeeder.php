<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Permission::query()->delete();
        create_permission('users lists','users.index');
        create_permission('users create','users.store,users.create');
        create_permission('users edit','users.edit,users.update');
        create_permission('users destroy','users.destroy');
        create_permission('roles lists','roles.index');
        create_permission('roles create','roles.store,roles.create');
        create_permission('roles edit','roles.edit,roles.update');
        create_permission('roles destroy','roles.destroy');
    }
}
