<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;
use App\Models\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'dev+team@legnd.com',
            'password' => bcrypt('BIGspender'),
        ]);
        $role = Role::where('slug', 'admin')->first();
        $user->attachRole($role);
    }
}
