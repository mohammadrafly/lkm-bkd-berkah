<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => password_hash('admin', PASSWORD_DEFAULT)
            ],
            [
                'name' => 'employee',
                'email' => 'employee@gmail.com',
                'role' => 'employee',
                'password' => password_hash('employee', PASSWORD_DEFAULT)
            ],
            [
                'name' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'role' => 'superadmin',
                'password' => password_hash('superadmin', PASSWORD_DEFAULT)
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
