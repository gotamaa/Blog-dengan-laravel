<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = User::factory(10)->create();
        $moderators = User::factory(1)->create();
        $admins = User::factory(1)->create();

        $role_author = Role::create(['name' => 'author']);
        $role_moderator = Role::create(['name' => 'moderator']);
        $role_admin = Role::create(['name' => 'admin']);

        ModelsPermission::create(['name' => 'create posts']);
        ModelsPermission::create(['name' => 'read posts']);
        ModelsPermission::create(['name' => 'delete posts']);
        ModelsPermission::create(['name' => 'update posts']);
        ModelsPermission::create(['name' => 'delete users']);

        $role_author->givePermissionTo('create posts');
        $role_author->givePermissionTo('read posts');

        $role_moderator->givePermissionTo('create posts');
        $role_moderator->givePermissionTo('read posts');
        $role_moderator->givePermissionTo('delete posts');
        $role_moderator->givePermissionTo('update posts');

        $role_admin->givePermissionTo('create posts');
        $role_admin->givePermissionTo('read posts');
        $role_admin->givePermissionTo('delete posts');
        $role_admin->givePermissionTo('update posts');
        $role_admin->givePermissionTo('delete users');

        // Assign 'author' role to each author
        $authors->each(function ($author) {
            $author->assignRole('author');
        });

        // Assign 'moderator' role to each moderator
        $moderators->each(function ($moderator) {
            $moderator->assignRole('moderator');
        });

        // Assign 'admin' role to each admin
        $admins->each(function ($admin) {
            $admin->assignRole('admin');
        });
    }
}
