<?php 
namespace app\modules\sparking;

class InitModule extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        // inicializa el módulo con la configuración cargada desde config.php
        \Yii::configure($this, require __DIR__ . '/config.php');

        if (\Yii::$app->user->can('admin') || \Yii::$app->user->can('cashier')) {
            // \Yii::$app->params['menus']['top_primary'] = array_merge(\Yii::$app->params['menus']['top_primary'], [
            //     [
            //         'label' => '<i class="bi bi-p-square-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem; color: cornflowerblue; text-align:center;"></i> Parqueadero',
            //         'ùrl' => ['/sparking/default'],
            //     ],
            // ]);
            \Yii::$app->params['menus']['top_primary'][] = [
                'label' => '<i class="bi bi-p-square-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem; color: cornflowerblue; text-align:center;"></i> Parqueadero',
                'url' => ['/sparking/default'],
            ];

            // $menu_admin = [
            //     [
            //         'label' => '<i class="bi bi-p-square-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"> '
            //             . '<i class="bi bi-card-list"></i>'
            //         . '</i> Actividad',
            //         'url' => ['/sparking/movements/index'],
            //     ],
            //     [
            //         'label' => '<i class="bi bi-p-square-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"> '
            //             . '<i class="bi bi-people-fill"></i>'
            //         . '</i> Miembros',
            //         'url' => ['/sparking/plans/index'],
            //     ],
            //     [
            //         'label' => '<i class="bi bi-p-square-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"> '
            //             . '<i class="bi bi-file-earmark-spreadsheet"></i>'
            //         . '</i> Informes',
            //         'items' => [
            //             [
            //                 'label' => 'Dia',
            //                 'url' => ['/sparking/default/reporte-dia'],
            //             ],
            //             [
            //                 'label' => 'Semana',
            //                 'url' => ['/sparking/default/reporte-semana'],
            //             ],
            //             [
            //                 'label' => 'Mes',
            //                 'url' => ['/sparking/default/reporte-mes'],
            //             ],
            //         ],
            //     ],
            // ];
            // \Yii::$app->params['menus']['top_primary'] = array_merge(\Yii::$app->params['menus']['top_primary'], [
            //     [
            //         'label' => '<i class="bi bi-p-square-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem; color: cornflowerblue; text-align:center;"></i> Parqueadero',
            //         'items' => array_merge([
            //             [
            //                 'label' => '<i class="bi bi-p-square-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"> '
            //                     . '<i class="bi bi-box-arrow-in-right"></i>'
            //                 . '</i> Ingreso',
            //                 'url' => ['/sparking/default/ingreso-vehiculo'],
            //             ],
            //             [
            //                 'label' => '<i class="bi bi-p-square-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"> '
            //                     . '<i class="bi bi-box-arrow-left"></i>'
            //                 . '</i> Salida',
            //                 'url' => ['/sparking/default/salida-vehiculo'],
            //             ],
            //             [
            //                 'label' => '<i class="bi bi-p-square-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"> '
            //                     . '<i class="bi bi-person-fill-add"></i>'
            //                 . '</i> Membresia',
            //                 'url' => ['/sparking/default/ingreso-plan'],
            //             ],
            //             [
            //                 'label' => '<i class="bi bi-p-square-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"> '
            //                     . '<i class="bi bi-person-lines-fill"></i>'
            //                 . '</i> Reporte',
            //                 'url' => ['/sparking/default/reporte-usuario'],
            //             ],
            //             [
            //                 'label' => '<i class="bi bi-p-square-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"> '
            //                     . '<i class="bi bi-shop-window"></i>'
            //                 . '</i> Vender',
            //                 'url' => ['/sparking/default/producto-caja'],
            //             ],
            //             [
            //                 'label' => '<i class="bi bi-p-square-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"> '
            //                     . '<i class="bi bi-cash-coin"></i>'
            //                 . '</i> Base caja',
            //                 'url' => ['/sparking/default/base-caja'],
            //             ],
            //         ], (\Yii::$app->user->can('admin')) ? $menu_admin : []),
            //     ],
            // ]);
        }
        
        if (\Yii::$app->user->can('admin')) {
            \Yii::$app->params['menus']['admin'] = array_merge(\Yii::$app->params['menus']['admin'], [
                '<hr class="dropdown-divider">',
                [
                    'label' => 'Parqueadero',
                    // 'linkOptions' => ['class' => 'nav-link link-body-emphasis px-2'],
                ],
                [
                    'label' => '<i class="bi bi-people"></i> Movimientos',
                    'url' => ['/sparking/movement/index'],
                    // 'linkOptions' => ['class' => 'nav-link link-body-emphasis px-2'],
                ],
                [
                    'label' => '<i class="bi bi-people"></i> Membresias',
                    'url' => ['/sparking/membership/index'],
                    // 'linkOptions' => ['class' => 'nav-link link-body-emphasis px-2'],
                ],
                [
                    'label' => '<i class="bi bi-people"></i> Tarifas',
                    'url' => ['/sparking/type-parking/index'],
                    // 'linkOptions' => ['class' => 'nav-link link-body-emphasis px-2'],
                ],
            ]);
            
            // \Yii::$app->params['menus']['top_primary'] = array_merge(\Yii::$app->params['menus']['top_primary'], );
        }
        

        // \Yii::$app->params['menus']['admin'][] = '<hr class="dropdown-divider">';
        // ...  otro código de inicialización ...
    }
}