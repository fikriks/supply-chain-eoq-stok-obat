<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

use App\Models\UserModel;

use CodeIgniter\Shield\Models\GroupModel;
use CodeIgniter\Shield\Models\UserIdentityModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel;
        $groupModel = new GroupModel;
        $userIdentityModel = new UserIdentityModel;
        $now = Time::now('Asia/Jakarta', 'id_ID');

        $admin = [
            'username' => 'admin123',
            'active' => 1
        ];

        $manajer = [
            'username' => 'manajer123',
            'active' => 1
        ];

        $staff = [
            'username' => 'staff123',
            'active' => 1
        ];

        $supplier = [
            'username' => 'supplier123',
            'active' => 1
        ];

        $pegawai = [
            'username' => 'pegawai123',
            'active' => 1
        ];

        $userModel->insert($admin);
        $adminId = $userModel->getInsertID();

        $userModel->insert($manajer);
        $manajerId = $userModel->getInsertID();

        $userModel->insert($staff);
        $staffId = $userModel->getInsertID();

        $userModel->insert($supplier);
        $supplierId = $userModel->getInsertID();

        $userModel->insert($pegawai);
        $pegawaiId = $userModel->getInsertID();

        $groups = [
            [
                'user_id' => $adminId,
                'group' => 'admin',
                'created_at' => $now
            ],
            [
                'user_id' => $manajerId,
                'group' => 'manajer',
                'created_at' => $now
            ],
            [
                'user_id' => $staffId,
                'group' => 'staff',
                'created_at' => $now
            ],
            [
                'user_id' => $supplierId,
                'group' => 'supplier',
                'created_at' => $now
            ],
            [
                'user_id' => $pegawaiId,
                'group' => 'pegawai',
                'created_at' => $now
            ]
        ];

        $groupModel->insertBatch($groups);

        $userIdentities = [
            // Admin
            [
                'user_id' => $adminId,
                'type' => 'email_password',
                'name' => 'Admin',
                'secret' => 'admin@gmail.com',
                // Password : 123456789
                'secret2' => '$2y$10$v5f4OFKyVBNsdmvZsUzHZOmGupJFivsmzgJrNrErhvdql0aiDH6M6',
                'created_at' => $now,
                'updated_at' => $now
            ],
            // Manajer
            [
                'user_id' => $manajerId,
                'type' => 'email_password',
                'name' => 'Manajer',
                'secret' => 'manajer@gmail.com',
                // Password : 123456789
                'secret2' => '$2y$10$v5f4OFKyVBNsdmvZsUzHZOmGupJFivsmzgJrNrErhvdql0aiDH6M6',
                'created_at' => $now,
                'updated_at' => $now
            ],
            // Staff
            [
                'user_id' => $staffId,
                'type' => 'email_password',
                'name' => 'Staff',
                'secret' => 'kadir@gmail.com',
                // Password : 123456789
                'secret2' => '$2y$10$v5f4OFKyVBNsdmvZsUzHZOmGupJFivsmzgJrNrErhvdql0aiDH6M6',
                'created_at' => $now,
                'updated_at' => $now
            ],
            // Supplier
            [
                'user_id' => $supplierId,
                'type' => 'email_password',
                'name' => 'Supplier',
                'secret' => 'supplier@gmail.com',
                // Password : 123456789
                'secret2' => '$2y$10$v5f4OFKyVBNsdmvZsUzHZOmGupJFivsmzgJrNrErhvdql0aiDH6M6',
                'created_at' => $now,
                'updated_at' => $now
            ],
            // Pegawai
            [
                'user_id' => $pegawaiId,
                'type' => 'email_password',
                'name' => 'Pegawai',
                'secret' => 'pegawai@gmail.com',
                // Password : 123456789
                'secret2' => '$2y$10$v5f4OFKyVBNsdmvZsUzHZOmGupJFivsmzgJrNrErhvdql0aiDH6M6',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ];

        $userIdentityModel->insertBatch($userIdentities);
    }
}
