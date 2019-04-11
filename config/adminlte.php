<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'HB Estoque',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>HB</b> Estoque',

    'logo_mini' => '<b>HB</b>',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login/microsoft',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'PRINCIPAL',
        [
            'text'        => 'Dashboard',
            'url'         => '/home',
            'icon'        => 'line-chart',
        ],
        [
            'text' => 'Relatórios',
            'url'  => '/#',
            'icon' => 'file-pdf-o',
            'submenu' => [

              [
                  'text' => 'Visão Geral Estoque',
                  'url'  => '/overviewreport',
                  'icon' => 'home',
              ],
              [
                  'text' => 'Estatísticas Mês Atual',
                  'url'  => '/statsmonthreport',
                  'icon' => 'calendar-o',
              ],

                [
                    'text' => 'Equipamentos',
                    'url'  => '/inventoryreport',
                    'icon' => 'laptop',
                ],
                [
                    'text' => 'Entrada de Equipamentos',
                    'url'  => '/#',
                    'icon' => 'sign-in',
                ],
                [
                    'text' => 'Saída de Equipamentos',
                    'url'  => '/requestreport',
                    'icon' => 'sign-out',
                ],

                [
                'text'    => 'Vencimentos e Expirações',
                'url'     => '/#',
                'icon' => 'clock-o',

                'submenu' => [
                    [
                        'text' => 'Contratos',
                        'url'  => '/contractreport',
                        'icon' => 'pencil-square-o',
                   ],
                     [
                        'text' => 'Domínios',
                        'url'  => '/domainreport',
                        'icon' => 'handshake-o',
                   ],
                   [
                    'text' => 'Certificados',
                    'url'  => '/certificatereport',
                    'icon' => 'expeditedssl',
               ],
                ],
            ],

            ]
        ],
        [
            'text' => 'Entrada e Saída',
            'url'  => '/#',
            'icon' => 'refresh',

            'submenu' => [

                [
                    'text' => 'Nota de Entrada',
                    'url'  => '/invoice',
                    'icon' => 'sign-in',
                ],

                [
                    'text' => 'Histórico de Entrada',
                    'url'  => '/invoicelist',
                    'icon' => 'history',
                ],
                [
                    'text' => 'Requisição de Saída',
                    'url'  => '/outgoingrequest',
                    'icon' => 'sign-out',
                ],
                [
                    'text' => 'Histórico de Saída',
                    'url'  => '/requestlist',
                    'icon' => 'history',

                    'submenu' => [

                        [
                            'text' => 'Histórico de Saída',
                            'url'  => '/requestlist',
                            'icon' => 'history',
                        ],
                        [
                            'text' => 'Minhas Saídas',
                            'url'  => '/myrequestslist',
                            'icon' => 'external-link',
                        ],
                    ],
                ],
        ],
    ],
    [
        'text' => 'Gestão de Contratos',
        'url'  => '/#',
        'icon' => 'pencil-square-o',

        'submenu' => [
            [
                'text' => 'Contratos',
                'url'  => '/contract',
                'icon' => 'pencil-square-o',
            ],

            [
                'text' => 'Histórico de Contratos',
                'url'  => '/contractlist',
                'icon' => 'history',
            ],
        ],
    ] ,
    [
        'text' => 'Gestão de Domínios',
        'url'  => '/#',
        'icon' => 'handshake-o',

        'submenu' => [
            [
                'text' => 'Domínios',
                'url'  => '/domain',
                'icon' => 'handshake-o',
            ],

            [
                'text' => 'Histórico de Domínios',
                'url'  => '/domainlist',
                'icon' => 'history',
            ],
        ],
    ] ,
    [
        'text' => 'Gestão de Certificados',
        'url'  => '/#',
        'icon' => 'expeditedssl',

        'submenu' => [
            [
                'text' => 'Certificados',
                'url'  => '/certificates',
                'icon' => 'expeditedssl',
            ],

            [
                'text' => 'Histórico de Certificados',
                'url'  => '/certificatelist',
                'icon' => 'history',
            ],
        ],
    ] ,
    [
        'text' => 'Gestão de Licenças',
        'url'  => '/#',
        'icon' => 'windows',

        'submenu' => [
            [
                'text' => 'Licenças',
                'url'  => '/license',
                'icon' => 'windows',
            ],

            [
                'text' => 'Histórico de Licenças',
                'url'  => '/licenselist',
                'icon' => 'history',
            ],
        ],
    ] ,
        'DADOS',
        [
            'text'    => 'Configurações',
            'icon'    => 'wrench',
            'submenu' => [
                [
                    'text'    => 'Produtos',
                    'url'     => '/#',
                    'icon' => 'product-hunt',

                    'submenu' => [
                        [
                            'text' => 'Categorias',
                            'url'  => '/categories',
                            'icon' => 'bars',
                        ],
                        [
                            'text' => 'Marcas',
                            'url'  => '/brands',
                            'icon' => 'trademark',
                        ],
                        [
                            'text' => 'Depósitos',
                            'url'  => '/deposits',
                            'icon' => 'home',
                        ],
                        [
                            'text' => 'Produtos',
                            'url'  => '/products',
                            'icon' => 'barcode',
                        ],
                    ],
                ],
                [
                    'text'    => 'Centro de Custo',
                    'url'     => '/#',
                    'icon' => 'credit-card-alt',

                    'submenu' => [
                        [
                            'text' => 'Centro de Custo',
                            'url'  => '/costcenter',
                            'icon' => 'credit-card-alt',
                        ],
                        [
                            'text' => 'Projeto',
                            'url'  => '/projects',
                            'icon' => 'map',
                        ],
                        [
                            'text' => 'Negócio',
                            'url'  => '/business',
                            'icon' => 'briefcase',
                        ],
                        [
                            'text' => 'Grupo de Clientes',
                            'url'  => '/clientgroup',
                            'icon' => 'address-book',
                        ],
                        [
                            'text' => 'Centro de Resultado',
                            'url'  => '/resultcenter',
                            'icon' => 'bar-chart',
                        ],
                        [
                            'text' => 'Área',
                            'url'  => '/areas',
                            'icon' => 'share-square-o',
                        ],
                        [
                            'text' => 'Vertical',
                            'url'  => '/verticals',
                            'icon' => 'vimeo',
                        ],
                    ],
                ],
                [
                    'text'    => 'Contratos',
                    'url'     => '/#',
                    'icon' => 'pencil-square-o',

                    'submenu' => [
                        [
                            'text' => 'Categorias',
                            'url'  => '/contractcategories',
                            'icon' => 'bars',
                       ],
					     [
                            'text' => 'Indice de Reajuste',
                            'url'  => '/index',
                            'icon' => 'bar-chart',
                       ],
                    ],
                ],
                [
                    'text' => 'Fornecedores',
                    'url'  => '/resellers',
                    'icon' => 'opencart',
                ],
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
    ],
];
