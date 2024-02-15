<?php 

namespace app\modules\sparking\models;

use \Yii;

class Menus {
    public static function addMenuParking() {
        
        $menu_admin = [
            // [
            //     'label' => '<i class="bi bi-people-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Membresias',
            //     'url' => ['/sparking/plans/index'],
            // ],
            [
                'label' => '<i class="bi bi-file-earmark-spreadsheet d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Informes',
                'items' => [
                    [
                        'label' => 'Actividad',
                        'url' => ['/sparking/movements/index'],
                    ],
                    [
                        'label' => 'Miembros',
                        'url' => ['/sparking/plans/index'],
                    ],
                    [
                        'label' => 'Dia',
                        'url' => ['/sparking/default/reporte-dia'],
                    ],
                    [
                        'label' => 'Semana',
                        'url' => ['/sparking/default/reporte-semana'],
                    ],
                    [
                        'label' => 'Mes',
                        'url' => ['/sparking/default/reporte-mes'],
                    ],
                ],
            ],
        ];
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
                    'label' => '<i class="bi bi-box-arrow-in-right d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Ingreso',
                    'url' => ['/sparking/default/ingreso-vehiculo'],
                ],
                [
                    'label' => '<i class="bi bi-box-arrow-left d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Salida',
                    'url' => ['/sparking/default/salida-vehiculo'],
                ],
                [
                    'label' => '<i class="bi bi-person-fill-add d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Miembro',
                    'url' => ['/sparking/default/ingreso-plan'],
                ],
                [
                    'label' => '<i class="bi bi-shop-window d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Vender',
                    'url' => ['/sparking/default/producto-caja'],
                ],
                [
                    'label' => '<i class="bi bi-cash-coin d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Base caja',
                    'url' => ['/sparking/default/base-caja'],
                ],
                [
                    'label' => '<i class="bi bi-person-lines-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Reporte',
                    'url' => ['/sparking/default/reporte-usuario'],
                ],
            ], (Yii::$app->user->can('admin')) ? $menu_admin : [])
        );

        return false;
    }
}