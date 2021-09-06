<?php

use App\Models\Setting;
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
        // Permissions Seeder
        Permission::query()->delete();
        create_permission('users lists', 'users.index');
        create_permission('users create', 'users.store,users.create');
        create_permission('users edit', 'users.edit,users.update');
        create_permission('users destroy', 'users.destroy');
        create_permission('roles lists', 'roles.index');
        create_permission('roles create', 'roles.store,roles.create');
        create_permission('roles edit', 'roles.edit,roles.update');
        create_permission('roles destroy', 'roles.destroy');

        // Settings Seeder
        Setting::query()->delete();
        DB::table('settings')->insert([
            'id'=>1,
            'about_app'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum',
            'app_commission'=>20,
            'alahly_account_num'=>'22',
            'account_name'=>'dasdasad',
            'raghy_account_num'=>'56'
        ]);

        // Admin Seeder
        DB::table('users')->insert([
            'id'=>1,
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('12345678'),
        ]);

        $role = \Spatie\Permission\Models\Role::create(['name' => 'super_admin']);
        $permissions = Permission::all();
        $role->syncPermissions($permissions);
        $user = \App\User::get()->first();
        $user->assignRole('super_admin');
    }
}
