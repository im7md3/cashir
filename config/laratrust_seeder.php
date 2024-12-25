<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'roles'    => 'c,r,u,d',
            'admins'   => 'c,r,u,d',
            'clients'  => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'settings' => 'r,u',
            'branches' => 'c,r,u,d',
            'departments' => 'c,r,u,d',
            'purchases' => 'c,r,u,d',
            'invoices' => 'c,r,u,d',
            'reservations' => 'c,r,u,d',
            'offers' => 'c,r,u,d',
            'payment_methods' => 'c,r,u,d',
            'packages' => 'c,r,u,d',
            'reports' => 'r',

        ],
        'admin' => [],
        'user' => [],
        'nothing' => [],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
