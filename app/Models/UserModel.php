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
            'telephone',
            'address',
            'last_active',
            'deleted_at',
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

    function getIdentityById($id = '')
    {
        $this->select('auth_identities.*,auth_identities.id as identity_id, auth_groups_users.*, auth_groups_users.id as group_id,users.id as id_user, users.*');

        $data = $this->join('auth_identities', 'users.id = auth_identities.user_id')
            ->join('auth_groups_users', 'users.id = auth_groups_users.user_id')
            ->where('auth_identities.user_id', $id)
            ->first();

        return $data;
    }
}
