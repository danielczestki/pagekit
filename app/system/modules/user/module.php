<?php

use Pagekit\User\Event\AccessListener;
use Pagekit\User\Event\AuthorizationListener;
use Pagekit\User\Event\LoginAttemptListener;
use Pagekit\User\Event\UserListener;
use Pagekit\User\Widget\LoginWidget;

return [

    'name' => 'system/user',

    'main' => 'Pagekit\\User\\UserModule',

    'autoload' => [

        'Pagekit\\User\\' => 'src'

    ],

    'routes' => [

        '/user' => [
            'name' => '@user',
            'controller' => [
                'Pagekit\\User\\Controller\\AuthController',
                'Pagekit\\User\\Controller\\ProfileController',
                'Pagekit\\User\\Controller\\RegistrationController',
                'Pagekit\\User\\Controller\\ResetPasswordController',
                'Pagekit\\User\\Controller\\UserController'
            ]
        ],
        '/api/user' => [
            'name' => '@user/api',
            'controller' => [
                'Pagekit\\User\\Controller\\RoleApiController',
                'Pagekit\\User\\Controller\\UserApiController'
            ]
        ]

    ],

    'resources' => [

        'system/user:' => ''

    ],

    'permissions' => [

        'user: manage users' => [
            'title' => 'Manage users',
            'trusted' => true
        ],
        'user: manage user permissions' => [
            'title' => 'Manage user permissions',
            'trusted' => true
        ],
        'user: manage settings' => [
            'title' => 'Manage settings',
            'trusted' => true
        ],
        'system: access admin area' => [
            'title' => 'Access admin area',
            'trusted' => true
        ]

    ],

    'menu' => [

        'user' => [
            'label' => 'Users',
            'icon' => 'system/user:assets/images/icon-users.svg',
            'url' => '@user',
            'active' => '@user*',
            'access' => 'user: manage users || user: manage user permissions',
            'priority' => 115
        ],
        'user: users' => [
            'label' => 'List',
            'parent' => 'user',
            'url' => '@user',
            'active' => '@user(/edit)?',
            'access' => 'user: manage users',
        ],
        'user: permissions' => [
            'label' => 'Permissions',
            'parent' => 'user',
            'url' => '@user/permissions',
            'access' => 'user: manage user permissions'
        ],
        'user: roles' => [
            'label' => 'Roles',
            'parent' => 'user',
            'url' => '@user/roles',
            'access' => 'user: manage user permissions'
        ],
        'user: settings' => [
            'label' => 'Settings',
            'parent' => 'user',
            'url' => '@user/settings',
            'access' => 'user: manage user settings'
        ]

    ],

    'config' => [

        'registration' => 'admin',
        'require_verification' => true,
        'users_per_page' => 20,

        'auth' => [
            'refresh_token' => false
        ]

    ],

    'events' => [

        'boot' => function($event, $app) {
            $app->subscribe(
                new AccessListener,
                new AuthorizationListener,
                new LoginAttemptListener,
                new UserListener
            );
        },

        'widget.types' => function ($event, $widgets) {
            $widgets->registerType(new LoginWidget());
        },

        'request' => function () use ($app) {
            $app['scripts']->register('widget-login', 'system/user:app/bundle/widgets/login.js', '~widgets');
            $app['scripts']->register('widget-user', 'system/user:app/bundle/widgets/user.js', '~dashboard');
        }

    ]

];
