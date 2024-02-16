<?php 

namespace app\modules\sparking\models;

use \Yii;

class Menus {
    public static function getMenuPrimary() {
        return [
            [
                'label' => '<i class="bi bi-box-arrow-in-right d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Ingreso',
                'url' => ['/sparking/default/ingreso-vehiculo'],
                'visible' => Yii::$app->user->can('cashier'),
                'options' => [
                    'title' => 'Registrar el ingreso de un vehiculo.'
                ],
            ],
            [
                'label' => '<i class="bi bi-box-arrow-left d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Salida',
                'url' => ['/sparking/default/salida-vehiculo'],
                'visible' => Yii::$app->user->can('cashier'),
                'options' => [
                    'title' => 'Registrar la salida de un vehiculo.'
                ],
            ],
            [
                'label' => '<i class="bi bi-person-fill-add d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Miembro',
                'url' => ['/sparking/default/ingreso-plan'],
                'visible' => Yii::$app->user->can('cashier'),
                'options' => [
                    'title' => 'Registrar un nuevo miembro.'
                ],
            ],
            [
                'label' => '<i class="bi bi-shop-window d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Vender',
                'url' => ['/sparking/default/producto-caja'],
                'visible' => Yii::$app->user->can('cashier'),
                'options' => [
                    'title' => 'Vender producto desde caja.'
                ],
            ],
            [
                'label' => '<i class="bi bi-cash-coin d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Base caja',
                'url' => ['/sparking/default/base-caja'],
                'visible' => Yii::$app->user->can('cashier'),
                'options' => [
                    'title' => 'Reportar la base de dinero en caja.'
                ],
            ],
            [
                'label' => '<i class="bi bi-person-lines-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Reporte',
                'url' => ['/sparking/default/reporte-usuario'],
                'visible' => Yii::$app->user->can('cashier'),
                'options' => [
                    'title' => 'Mi reporte de ingresos del dia.'
                ],
            ],
        ];
    }
    
    public static function getMenuPrimaryExtra() {
        return [
            [
                'label' => '<i class="bi bi-receipt d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Actividad',
                'url' => ['/sparking/default/activity'],
                'visible' => Yii::$app->user->can('cashier'),
            ],
            [
                'label' => '<i class="bi bi-people-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Miembros',
                'url' => ['/sparking/default/members'],
                'visible' => Yii::$app->user->can('cashier'),
            ],
        ];
    }
    
    public static function getMenuAdmin() {
        return [
            // [
            //     'label' => '<i class="bi bi-people-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Membresias',
            //     'url' => ['/sparking/plans/index'],
            // ],
            [
                'label' => '<i class="bi bi-file-earmark-spreadsheet d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Informes',
                'visible' => Yii::$app->user->can('admin'),
                'items' => [
                    [
                        'label' => 'Dia',
                        'url' => ['/sparking/default/reporte-dia'],
                        'visible' => Yii::$app->user->can('admin'),
                    ],
                    [
                        'label' => 'Semana',
                        'url' => ['/sparking/default/reporte-semana'],
                        'visible' => Yii::$app->user->can('admin'),
                    ],
                    [
                        'label' => 'Mes',
                        'url' => ['/sparking/default/reporte-mes'],
                        'visible' => Yii::$app->user->can('admin'),
                    ],
                    '<hr class="dropdown-divider">',
                    [
                        'label' => 'Personalizar',
                        'url' => ['/sparking/default/reporte'],
                        'visible' => Yii::$app->user->can('admin'),
                    ],
                ],
            ],
        ];
    }

    public static function addMenuParking() 
    {
        Yii::$app->params['menus']['top_secondary'] = array_merge(
            Yii::$app->params['menus']['top_secondary'], 
            // [
            //     [
            //         'label' => '<i class="bi bi-p-square-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem; color: cornflowerblue; text-align:center;"></i> Parqueadero',
            //         'items' => ,
            //     ],
            // ]
            array_merge([
                [
                    'label' => '<i class="bi bi-house-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Inicio',
                    'url' => ['/sparking/default/index'],
                    'visible' => !Yii::$app->user->isGuest,
                ]], self::getMenuPrimary(), self::getMenuPrimaryExtra(), (Yii::$app->user->can('admin')) ? self::getMenuAdmin() : [])
        );
        return true;
    }
}