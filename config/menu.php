<?php

return [
    'admin' => [
        [
            'icon' => '<i class="fas fa-chart-bar"></i>',
            'title' => 'Home',
            'route' => 'admin.home',
            'permissions' => ['admin'],
            'childs' => null
        ],
        [
            'icon' => '<i class="fas fa-tachometer-alt"></i>',
            'title' => 'Post',
            'route' => '#',
            'permissions' => ['admin'],
            'childs' => [
                [
                    'index' => 1,
                    'title' => 'List',
                    'permissions' => ['admin'], 
                    'route' => 'admin.post.index'
                ],
                [
                    'index' => 2,
                    'title' => 'Create',
                    'permissions' => ['admin'], 
                    'route' => 'admin.post.create'
                ]
            ]
        ],
        [
            'icon' => '<i class="fas fa-tachometer-alt"></i>',
            'title' => 'User',
            'route' => '#',
            'permissions' => ['admin'],
            'childs' => [
                [
                    'index' => 1,
                    'title' => 'List',
                    'permissions' => ['admin'], 
                    'route' => 'admin.user.index'
                ],
                [
                    'index' => 2,
                    'title' => 'Create',
                    'permissions' => ['admin'], 
                    'route' => 'admin.user.create'

                ]
            ]
        ],
        [
            'icon' => '<i class="fas fa-tachometer-alt"></i>',
            'title' => 'Role',
            'route' => '#',
            'permissions' => ['admin'],
            'childs' => [
                [
                    'index' => 1,
                    'title' => 'List',
                    'permissions' => ['admin'], 
                    'route' => 'admin.role.index'
                ],
                [
                    'index' => 2,
                    'title' => 'Create',
                    'permissions' => ['admin'], 
                    'route' => 'admin.role.create'

                ]
            ]
        ],
        [
            'icon' => '<i class="fas fa-tachometer-alt"></i>',
            'title' => 'Permission',
            'route' => '#',
            'permissions' => ['admin'],
            'childs' => [
                [
                    'index' => 1,
                    'title' => 'List',
                    'permissions' => ['admin'], 
                    'route' => 'admin.permission.index'
                ],
                [
                    'index' => 2,
                    'title' => 'Create',
                    'permissions' => ['admin'], 
                    'route' => 'admin.permission.create'

                ]
            ]
        ],
       

    ]
];