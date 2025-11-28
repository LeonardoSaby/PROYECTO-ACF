<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    */

    'title' => 'ACF', // Nuevo título principal
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon (Mantener si no tienes uno nuevo)
    |--------------------------------------------------------------------------
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    */

    // Se usa la clase 'text-indigo-400' para el color de acento
    'logo' => '<b class="text-indigo-400">ACF</b>', 
    'logo_img' => 'images/logo_guarderia.png', 
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'KidzApp Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    */

    'auth_logo' => [
        'enabled' => false, // Puedes habilitarlo si quieres un logo diferente en Login/Registro
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    */

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'KidzApp Preloader',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-indigo', // Cambiado a índigo
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout (Fijar elementos para una apariencia moderna)
    |--------------------------------------------------------------------------
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true, // Fija el sidebar para mejor UX
    'layout_fixed_navbar' => true, // Fija el navbar
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes (Diseño de Login/Registro)
    |--------------------------------------------------------------------------
    */

    'classes_auth_card' => 'card-outline card-indigo', // Borde de la tarjeta índigo
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-indigo', // Botón principal índigo

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes (Colores y Apariencia)
    |--------------------------------------------------------------------------
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    // Sidebar azul oscuro
'classes_sidebar' => 'sidebar-dark-primary elevation-4', 
'classes_sidebar_nav' => '',

// Navbar azul oscuro
'classes_topnav' => 'navbar-dark navbar-primary', 
'classes_topnav_nav' => 'navbar-expand',
'classes_topnav_container' => 'container',


    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,
    'disable_darkmode_routes' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Asset Bundling
    |--------------------------------------------------------------------------
    */

    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items (Mantenidos con los íconos actualizados)
    |--------------------------------------------------------------------------
    */

    'menu' => [
        // Navbar items:
        [
            'type' => 'navbar-search',
            'text' => 'Buscar...', // Texto de búsqueda
            'topnav_right' => true,
        ],
        

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'Buscar en el menú...', // Texto de búsqueda
        ],
        // Ítems de ejemplo, puedes eliminar este.
        [
            'text' => 'Escritorio',
            'url' => 'home', // Asumiendo que 'home' es el dashboard
            'icon' => 'fas fa-home',
        ],
        
        // --- SECCIÓN DE MENÚ COPIADA CON ICONOS CORRECTOS ---
        
        //acceso y seguridad
                            //tercer nivel
                        [
                            'text' => 'Acceso y Seguridad',
                            'icon' => 'fas fa-users-cog',
                            'submenu' => [
                                [
                                    'text' => 'Usuarios',
                                    'url'  => 'users',
                                    'icon' => 'fas fa-users',
                                    
                                ],
                                [
                                'text' => 'Roles',
                                'url'  => 'roles',
                                'icon' => 'fas fa-user-shield',
                                ],
                                [
                                'text' => 'Roles y Usuarios',
                                'url'  => 'model-has-roles',
                                'icon' => 'fas fa-user-shield',
                                ],
                                
                            ],
                        ],
        [
            'text' => 'Parametrización',
            'icon' => 'fas fa-cogs', 
            'submenu' => [ 
                [
                    'text' => 'Tutores',
                    'url' => 'tutores',
                    'icon' => 'fas fa-user-friends', 
                ],
                [
                    'text' => 'Infantes',
                    'url' => 'infantes',
                    'icon' => 'fas fa-child', 
                ],
                
                
                [
                    'text' => 'Salas',
                    'url' => 'salas',
                    'icon' => 'fas fa-door-open', 
                ],
                [
                    'text' => 'Niveles',
                    'url' => 'niveles',
                    'icon' => 'fas fa-layer-group', 
                ],
                [
                    'text' => 'Cursos',
                    'url' => 'cursos',
                    'icon' => 'fas fa-book-open', 
                ],
                [
                    'text' => 'Docentes',
                    'url' => 'docentes',
                    'icon' => 'fas fa-chalkboard-teacher', 
                ],
                [
                    'text' => 'Turnos',
                    'url' => 'turnos',
                    'icon' => 'fas fa-clock', 
                ],
                
            ],
        ],
        [
            'text' => 'Transacciones',
            'icon' => 'fas fa-exchange-alt', 
            'submenu' => [
                [
                    'text' => 'Inscripciones',
                    'url' => 'inscripciones',
                    'icon' => 'fas fa-user-plus', 
                ],
                [
                    'text' => 'Asistencias',
                    'url' => 'asistencias',
                    'icon' => 'fas fa-calendar-check', 
                ],
                
                
            ],
        ],
        [
    'text' => 'Reportes',
    'icon' => 'fas fa-exchange-alt',
    'submenu' => [
        [
            'text' => 'comportante de inscripcion',
            'route' => 'reportes.comprobante_index', // <--- usar 'route' en lugar de 'url' 
            'icon' => 'fas fa-user-plus',
        ],
        
        [
            'text' => 'Lista general de inscritos',
            'route' => 'reportes.lista_general', // <--- usar 'route' en lugar de 'url'
            'icon' => 'fas fa-user-plus',
        ],
        [
            'text' => 'Lista filtrada por curso y turno',
            'route' => 'reportes.form_filtrar',
            'icon' => 'fas fa-filter',
        ],
        [
            'text' => 'Lista de Asistencias',
            'url' => 'reportes/asistencias', // coincide con la ruta
            'icon' => 'fas fa-file-alt',
        ],
        
    ],
],
[
    'text' => 'Vista Tutor',
    'route' => 'tutor.vista',
    'icon' => 'fas fa-chalkboard-teacher',
]




        // --- FIN DE SECCIÓN DE MENÚ COPIADA ---
        
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    */

    'plugins' => [
        // Se dejan sin cambios
        'Datatables' => ['active' => false, 'files' => [/* ... */]],
        'Select2' => ['active' => false, 'files' => [/* ... */]],
        'Chartjs' => ['active' => false, 'files' => [/* ... */]],
        'Sweetalert2' => ['active' => false, 'files' => [/* ... */]],
        'Pace' => ['active' => false, 'files' => [/* ... */]],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    */

    'livewire' => false,
];