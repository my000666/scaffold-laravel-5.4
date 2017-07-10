<?php

return [
    'role_structure' => [
        'super' => [
            'module-roles' => 'c,r,u,d',
            'module-admins' => 'c,r,u,d',
            'module-users' => 'c,r,u,d',
            'module-home' => 'c,r,u,d',
            'module-profile' => 'r,u',

            'role-super' => 'c,r,u,d',
            'role-admin' => 'c,r,u,d',
            'role-officer' => 'c,r,u,d',
            'role-customer' => 'c,r,u,d',
            'role-tester' => 'c,r,u,d',
        ],
        'admin' => [
            'module-admins' => 'c,r,u,d',
            'module-users' => 'c,r,u,d',
            'module-home' => 'c,r,u,d',
            'module-profile' => 'r,u',

            'role-officer' => 'c,r,u,d',
            'role-customer' => 'c,r,u,d',
            'role-tester' => 'c,r,u,d',
        ],
        'officer' => [
            'module-users' => 'c,r,u,d',
            'module-home' => 'r,u',
            'module-profile' => 'r,u',

            'role-customer' => 'c,r,u,d',
            'role-tester' => 'c,r,u,d',
        ],
        'customer' => [
            'module-home' => 'r,u',
            'module-profile' => 'r,u',
        ],
        'tester' => [
            'module-home' => 'r,u'
        ],
    ],
    'mode_structure' => [
        'admin' => [
            'super', 'admin', 'officer'
        ],
        'customer' => [
            'customer', 'tester'
        ]
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
