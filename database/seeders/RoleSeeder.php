<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ["name"=> "Super Admin",],
        ];
        
        foreach ($roles as $role) {
           $id =  Role::create($role)->id;
           User::create([
            'name' => 'Fortu Signage',
            'email' => 'fortu.signage@gmail.com',
            'password' => Hash::make('Password!2'),
            'role_id' => $id,
           ]);
        }
    }
}
