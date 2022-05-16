<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'              => 'Superadmin',
                'email'             => 'superadmin@gmail.com',
                'password'          => Hash::make('Admin@123'),
                'role'              => 'superadmin', // Superadmin
                'remember_token'    => NULL,
                'created_at'        => date('Y-m-d h:i:s'),
                'updated_at'        => date('Y-m-d h:i:s'),
                'username'          => 'superadmin',
            ],
            [
                'name'              => 'Admin',
                'email'             => 'admin@gmail.com',
                'password'          => Hash::make('Admin@123'),
                'role'              => 'admin1', // Admin 
                'remember_token'    => NULL,
                'created_at'        => date('Y-m-d h:i:s'),
                'updated_at'        => date('Y-m-d h:i:s'),
                'username'          => 'admin',
            ],
            [
                'name'              => 'dr. Yesicca Juliane Chandra',
                'email'             => 'yessicajuliane@puskesmas.com',
                'password'          => Hash::make('Dokter@123'),
                'role'              => 'dokter', // Admin 
                'remember_token'    => NULL,
                'created_at'        => date('Y-m-d h:i:s'),
                'updated_at'        => date('Y-m-d h:i:s'),
                'username'          => 'yesiccajuliane',
            ],
        ];

        User::insert($users);
    }
}
