<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',

    'bsVersion' => "5.x",
    'menus' => [
        'top_left' => [
            // [
            //     'label' => 'Acerca de', 'url' => ['/site/about'],
            //     // 'linkOptions' => ['class' => 'nav-link link-body-emphasis px-2'],
            // ],
        ],
        'top_right' => [
            // [
            //     'label' => 'Ayuda', 'url' => ['/site/help'],
            // ],
            // [
            //     'label' => 'Contacto', 'url' => ['/site/contact'],
            // ],
        ],
        'top_primary' => [
            // [
            //     'label' => '<i class="bi bi-house d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem; color: cornflowerblue; text-align:center;"></i> Inicio',
            //     'url' => ['/site/index'],
            //     // 'linkOptions' => ['class' => 'nav-link link-body-emphasis px-2'],
            // ],
        ],
        'top_secondary' => [
            // [
            //     'label' => 'Ayuda', 'url' => ['/site/help'],
            // ],
            // [
            //     'label' => 'Contacto', 'url' => ['/site/contact'],
            // ],
        ],
        'my_account' => [
            [
                'label' => 'Mi perfil',
                'url' => ['/site/profile'],
            ],
            // [
            //     'label' => 'Cambiar contraseña',
            //     'url' => ['/site/my-password'],
            // ],
            [
                'label' => 'Ajustes',
                'url' => ['/site/settings'],
            ],
        ],
        'admin' => [
            [
                'label' => '<i class="bi bi-people"></i> Usuarios',
                'url' => ['/users/index'],
            ],
            [
                'label' => '<i class="bi bi-people"></i> Roles y permisos',
                'url' => ['/roles/index'],
            ],
            [
                'label' => '<i class="bi bi-people"></i> Opciones',
                'url' => ['/option/index'],
            ],
        ],
    ],
];
