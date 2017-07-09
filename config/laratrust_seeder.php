<?php

return [
    'role_structure' => [
        'super' => [
            'module-roles' => 'c,r,u,d',
            'module-admins' => 'c,r,u,d',
            'module-users' => 'c,r,u,d',
            'module-home' => 'c,r,u,d',
            'module-profile' => 'r,u',

            'role-admin-super' => 'c,r,u,d',
            'role-admin-admin' => 'c,r,u,d',
            'role-admin-officer' => 'c,r,u,d',
            'role-user-user' => 'c,r,u,d',
        ],
        'admin' => [
            'module-admins' => 'c,r,u,d',
            'module-users' => 'c,r,u,d',
            'module-home' => 'c,r,u,d',
            'module-profile' => 'r,u',

            'role-admin-officer' => 'c,r,u,d',
            'role-user-user' => 'c,r,u,d',
        ],
        'officer' => [
            'module-users' => 'c,r,u,d',
            'module-home' => 'r,u',
            'module-profile' => 'r,u',

            'role-user-user' => 'c,r,u,d',
        ],
        'user' => [
            'module-home' => 'r,u',
            'module-profile' => 'r,u',
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
