<?php

return [

    'session' => 'cartalyst_sentinel',

    'cookie' => 'cartalyst_sentinel',

    'users' => [
        'model' => Comptechsoft\Helpers\Models\Cartalyst\Users\User::class,
    ],

    'roles' => [
        'model' =>  Comptechsoft\Helpers\Models\Cartalyst\Roles\Role::class,
    ],

    'permissions' => [
        'class' => 'Cartalyst\Sentinel\Permissions\StandardPermissions',
    ],

    'persistences' => [
        'model' =>  Comptechsoft\Helpers\Models\Cartalyst\Persistences\Persistence::class,
        'single' => false,
    ],

    'checkpoints' => [
        'throttle',
        'activation',
    ],

    'activations' => [
        'model' => Comptechsoft\Helpers\Models\Cartalyst\Activations\Activation::class,
        'expires' => 259200,
        'lottery' => [2, 100],
    ],

    'reminders' => [
        'model' =>  Comptechsoft\Helpers\Models\Cartalyst\Reminders\Reminder::class,
        'expires' => 14400,
        'lottery' => [2, 100],
    ],

    'throttling' => [
        'model' =>  Comptechsoft\Helpers\Models\Cartalyst\Throttling\Throttle::class,
        'global' => [
            'interval' => 900,
            'thresholds' => [
                10 => 1,
                20 => 2,
                30 => 4,
                40 => 8,
                50 => 16,
                60 => 12
            ],
        ],
        'ip' => [
            'interval' => 900,
            'thresholds' => 5,
        ],
        'user' => [
            'interval' => 900,
            'thresholds' => 5,
        ],

    ],

];
