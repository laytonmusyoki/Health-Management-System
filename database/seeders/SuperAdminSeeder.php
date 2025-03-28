<?php
namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);

        $permissions = Permission::all();
        $superAdminRole->syncPermissions($permissions);

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'laytonmatheka7@gmail.com',
            'password' => bcrypt('Admin123'),
            'otp_enabled' => false,
            'role'=>'staff'
        ]);
        

        $user->assignRole('Super Admin');
    }
}
