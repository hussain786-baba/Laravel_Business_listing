<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [


            
            ['title' => 'user_management_access',],
            ['title' => 'user_management_create',],
            ['title' => 'user_management_edit',],
            ['title' => 'user_management_view',],
            ['title' => 'user_management_delete',],
            ['title' => 'permission_access',],
            ['title' => 'permission_create',],
            ['title' => 'permission_edit',],
            ['title' => 'permission_view',],
            [ 'title' => 'permission_delete',],
            [ 'title' => 'role_access',],
            [ 'title' => 'role_create',],
            [ 'title' => 'role_edit',],
            [ 'title' => 'role_view',],
            [ 'title' => 'role_delete',],
            [ 'title' => 'user_access',],
            [ 'title' => 'user_create',],
            [ 'title' => 'user_edit',],
            [ 'title' => 'user_view',],
            [ 'title' => 'user_delete',],
            [ 'title' => 'category_access',],
            [ 'title' => 'category_create',],
            [ 'title' => 'category_edit',],
            [ 'title' => 'category_view',],
            [ 'title' => 'category_delete',],
            [ 'title' => 'property_access',],
            [ 'title' => 'property_create',],
            [ 'title' => 'property_edit',],
            [ 'title' => 'property_view',],
            [ 'title' => 'property_delete',],
            [ 'title' => 'blogcategory_access',],
            [ 'title' => 'blogcategory_create',],
            [ 'title' => 'blogcategory_edit',],
            [ 'title' => 'blogcategory_view',],
            [ 'title' => 'blogcategory_delete',],
            [ 'title' => 'blog_access',],
            [ 'title' => 'blog_create',],
            [ 'title' => 'blog_edit',],
            [ 'title' => 'blog_view',],
            [ 'title' => 'blog_delete',],
            [ 'title' => 'addcategory_access',],
            [ 'title' => 'addcategory_edit',],
            [ 'title' => 'addcategory_create',],
            [ 'title' => 'addcategory_view',],
            [ 'title' => 'addcategory_delete',],
            [ 'title' => 'add_access',],
            [ 'title' => 'add_create',],
            [ 'title' => 'add_edit',],
            [ 'title' => 'add_view',],
            [ 'title' => 'add_delete',]
        ];

            Permission::insert($permissions);

    }
}
