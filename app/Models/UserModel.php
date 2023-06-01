<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserModel extends ShieldUserModel
{
    protected function initialize(): void
    {
        parent::initialize();

        $this->allowedFields = [
            ...$this->allowedFields,

            // 'first_name',
            'username',
            'status',
            'status_message',
            'active',
            'last_active',
            'deleted_at',
            'permissions',
            'employee_id'
        ];
    }

    function getIdentity()
    {
        $this->select('auth_identities.*,auth_identities.id as identity_id, auth_groups_users.*, auth_groups_users.id as group_id,users.*');

        $data = $this->join('auth_identities', 'users.id = auth_identities.user_id')
            ->join('auth_groups_users', 'users.id = auth_groups_users.user_id')
            ->findAll();

        return $data;
    }
}
