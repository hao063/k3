<?php

return [
    'admin' => [
        [
            'icon' => '<i class="fas fa-chart-bar"></i>',
            'title' => 'Home',
            'route' => 'admin.home',
            'permissions' => [],
            'childs' => null
        ],
        [
            'icon' => '<i class="fas fa-tachometer-alt"></i>',
            'title' => 'Post',
            'route' => '#',
            'permissions' => ['supper-admin', 'manager-post', 'read-post'],
            'childs' => [
                [
                    'index' => 1,
                    'title' => 'List',
                    'permissions' => ['supper-admin', 'manager-post', 'read-post'], 
                    'route' => 'admin.post.index'
                ],
                [
                    'index' => 2,
                    'title' => 'Create',
                    'permissions' => ['supper-admin', 'manager-post'], 
                    'route' => 'admin.post.create'
                ]
            ]
        ],
        [
            'icon' => '<i class="fas fa-tachometer-alt"></i>',
            'title' => 'User',
            'route' => '#',
            'permissions' => ['supper-admin', 'read-user', 'manager-user'],
            'childs' => [
                [
                    'index' => 1,
                    'title' => 'List',
                    'permissions' => ['supper-admin', 'manager-user', 'read-user'], 
                    'route' => 'admin.user.index'
                ],
                [
                    'index' => 2,
                    'title' => 'Create',
                    'permissions' => ['supper-admin', 'manager-user'], 
                    'route' => 'admin.user.create'

                ]
            ]
        ],
        [
            'icon' => '<i class="fas fa-tachometer-alt"></i>',
            'title' => 'Role',
            'route' => '#',
            'permissions' => ['supper-admin', 'manager-role-permission'],
            'childs' => [
                [
                    'index' => 1,
                    'title' => 'List',
                    'permissions' => ['supper-admin', 'manager-role-permission'], 
                    'route' => 'admin.role.index'
                ],
                [
                    'index' => 2,
                    'title' => 'Create',
                    'permissions' => ['supper-admin', 'manager-role-permission'], 
                    'route' => 'admin.role.create'

                ]
            ]
        ],
        [
            'icon' => '<i class="fas fa-tachometer-alt"></i>',
            'title' => 'Permission',
            'route' => '#',
            'permissions' => ['supper-admin', 'manager-role-permission'],
            'childs' => [
                [
                    'index' => 1,
                    'title' => 'List',
                    'permissions' => ['supper-admin', 'manager-role-permission'], 
                    'route' => 'admin.permission.index'
                ],
                [
                    'index' => 2,
                    'title' => 'Create',
                    'permissions' => ['supper-admin', 'manager-role-permission'], 
                    'route' => 'admin.permission.create'

                ]
            ]
        ],
       

    ]
];