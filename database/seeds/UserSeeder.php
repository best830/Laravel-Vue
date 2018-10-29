<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'tutor']);
        $role = Role::create(['name' => 'student']);
        // $permission = Permission::create(['name' => 'edit articles']);

        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('admin')
        ])->assignRole('admin');

        User::create([
            'name' => 'admin2',
            'email' => 'admin2@example.com',
            'password' => bcrypt('admin')
        ])->assignRole('admin');

        User::create([
            'name' => 'tutor',
            'email' => 'tutor@example.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('tutor')
        ])->assignRole('tutor');

        User::create([
            'name' => 'tutor2',
            'email' => 'tutor2@example.com',
            'password' => bcrypt('tutor')
        ])->assignRole('tutor');

        User::create([
            'name' => 'student',
            'email' => 'student@example.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('student')
        ])->assignRole('student');

        User::create([
            'name' => 'student2',
            'email' => 'student2@example.com',
            'password' => bcrypt('student')
        ])->assignRole('student');
    }
}
