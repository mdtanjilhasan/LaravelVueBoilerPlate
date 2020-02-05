<?php

return [
    'role_structure' => [
        'administrator' => [
            'users' => 'c,r,u,d,s,a,b',
            'roles' => 'c,r,u,d,s,a,b',
            'category' => 'c,r,u,d,s,a,b',
            'profile' => 'c,r,u,d,s,a,b',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        's' => 'show',
        'a' => 'active',
        'b' => 'banned',
    ]
];
