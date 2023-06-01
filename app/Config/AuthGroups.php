<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Shield\Config\AuthGroups as ShieldAuthGroups;

class AuthGroups extends ShieldAuthGroups
{
    /**
     * --------------------------------------------------------------------
     * Default Group
     * --------------------------------------------------------------------
     * The group that a newly registered user is added to.
     */
    public string $defaultGroup = 'user';

    /**
     * --------------------------------------------------------------------
     * Groups
     * --------------------------------------------------------------------
     * An associative array of the available groups in the system, where the keys
     * are the group names and the values are arrays of the group info.
     *
     * Whatever value you assign as the key will be used to refer to the group
     * when using functions such as:
     *      $user->addGroup('superadmin');
     *
     * @var array<string, array<string, string>>
     *
     * @see https://github.com/codeigniter4/shield/blob/develop/docs/quickstart.md#change-available-groups for more info
     */
    public array $groups = [
        'admin' => [
            'title'       => 'Admin'
        ],
        'manajer' => [
            'title'       => 'Manajer'
        ],
        'staff' => [
            'title'       => 'Staff'
        ],
        'supplier' => [
            'title'       => 'Supplier'
        ],
        'pegawai' => [
            'title'       => 'Pegawai'
        ],
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions
     * --------------------------------------------------------------------
     * The available permissions in the system.
     *
     * If a permission is not listed here it cannot be used.
     */
    public array $permissions = [
        'admin.access'        => 'Can access the sites admin area',
        'admin.settings'      => 'Can access the main site settings',
        'users.manage-admins' => 'Can manage other admins',
        'users.create'        => 'Can create new non-admin users',
        'users.edit'          => 'Can edit existing non-admin users',
        'users.delete'        => 'Can delete existing non-admin users'
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions Matrix
     * --------------------------------------------------------------------
     * Maps permissions to groups.
     *
     * This defines group-level permissions.
     */
    public array $matrix = [
        'admin' => [
            'admin.*',
            'users.*',
            'beta.*',
        ],
        'manajer' => [
            'admin.access',
            'users.create',
            'users.edit',
            'users.delete'
        ],
        'staff' => [
            'admin.access',
            'users.create',
            'users.edit',
            'users.delete'
        ],
        'supplier' => [
            'admin.access',
            'users.create',
            'users.edit',
            'users.delete'
        ],
        'pegawai' => [
            'admin.access',
            'users.create',
            'users.edit',
            'users.delete'
        ],
    ];
}
