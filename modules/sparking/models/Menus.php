<?php 

namespace app\modules\sparking\models;

use \Yii;
use yii\helpers\Url;

class Menus {
    public static function getMenuPrimary() {
        return [
            [
                'label' => '<i class="bi bi-box-arrow-in-right d-none d-md-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Ingreso',
                'url' => ['/sparking/default/ingreso-vehiculo'],
                'visible' => Yii::$app->user->can('cashier'),
                'options' => [
                    'title' => 'Registrar el ingreso de un vehiculo.'
                ],
            ],
            [
                'label' => '<i class="bi bi-box-arrow-left d-none d-md-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Salida',
                'url' => ['/sparking/default/salida-vehiculo'],
                'visible' => Yii::$app->user->can('cashier'),
                'options' => [
                    'title' => 'Registrar la salida de un vehiculo.'
                ],
            ],
            [
                'label' => '<i class="bi bi-person-fill-add d-none d-md-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Miembro',
                'url' => ['/sparking/default/ingreso-plan'],
                'visible' => Yii::$app->user->can('cashier'),
                'options' => [
                    'title' => 'Registrar un nuevo miembro.'
                ],
            ],
            [
                'label' => '<i class="bi bi-shop-window d-none d-md-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Vender',
                'url' => ['/sparking/default/producto-caja'],
                'visible' => Yii::$app->user->can('cashier'),
                'options' => [
                    'title' => 'Vender producto desde caja.'
                ],
            ],
            [
                'label' => '<i class="bi bi-cash-coin d-none d-md-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Base caja',
                'url' => ['/sparking/default/base-caja'],
                'visible' => Yii::$app->user->can('cashier'),
                'options' => [
                    'title' => 'Reportar la base de dinero en caja.'
                ],
            ],
            [
                'label' => '<i class="bi bi-person-lines-fill d-none d-md-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Reporte',
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
                'label' => '<i class="bi bi-receipt d-none d-md-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Actividad',
                'url' => ['/sparking/default/activity'],
                'visible' => Yii::$app->user->can('cashier'),
                'options' => [
                    'title' => 'Todos los registros hasta el momento.'
                ],
            ],
            [
                'label' => '<i class="bi bi-people-fill d-none d-md-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Miembros',
                'url' => ['/sparking/default/members'],
                'visible' => Yii::$app->user->can('cashier'),
                'options' => [
                    'title' => 'Miembros hasta el momento.'
                ],
            ],
        ];
    }
    
    public static function getMenuAdmin() {
        return [
            // [
            //     'label' => '<i class="bi bi-people-fill d-none d-md-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Membresias',
            //     'url' => ['/sparking/plans/index'],
            // ],
            [
                'label' => '<i class="bi bi-file-earmark-spreadsheet d-none d-md-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Informes',
                'visible' => Yii::$app->user->can('admin'),
                'items' => [
                    [
                        'label' => 'Dia',
                        'url' => ['/sparking/default/reporte-dia'],
                        'visible' => Yii::$app->user->can('admin'),
                        'options' => [
                            'title' => 'Revise los movimientos del dia.'
                        ],
                    ],
                    [
                        'label' => 'Semana',
                        'url' => ['/sparking/default/reporte-semana'],
                        'visible' => Yii::$app->user->can('admin'),
                        'options' => [
                            'title' => 'Revise los movimientos de la semana.'
                        ],
                    ],
                    [
                        'label' => 'Mes',
                        'url' => ['/sparking/default/reporte-mes'],
                        'visible' => Yii::$app->user->can('admin'),
                        'options' => [
                            'title' => 'Revise los movimientos del mes.'
                        ],
                    ],
                    '<hr class="dropdown-divider">',
                    [
                        'label' => 'Personalizado',
                        'url' => ['/sparking/default/reporte'],
                        'visible' => Yii::$app->user->can('admin'),
                        'options' => [
                            'title' => 'Revise los movimientos segun los filtros que necesita.'
                        ],
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
            //         'label' => '<i class="bi bi-p-square-fill d-none d-md-block mx-auto mb-1" style="font-size: 1.5rem; color: cornflowerblue; text-align:center;"></i> Parqueadero',
            //         'items' => ,
            //     ],
            // ]
            array_merge([
                // [
                //     'label' => '<i class="bi bi-house-fill d-none d-md-block mx-auto mb-1" style="font-size: 1.5rem;text-align:center;"></i> Inicio',
                //     'url' => ['/sparking/default/index'],
                //     'visible' => !Yii::$app->user->isGuest,
                // ],
            ], self::getMenuPrimary(), self::getMenuPrimaryExtra(), (Yii::$app->user->can('admin')) ? self::getMenuAdmin() : [])
        );
        return true;
    }

    public static function createGridIcons($items = []) 
    {
        $r = '';
        foreach ($items as $item) {
            $r .= self::createGridIcon($item);
        }
        return $r;
    }

    public static function createGridIcon($item, $parent = '') 
    {
        $label = ($item['label'] ?? (is_string($item) ? $item : json_encode($item)));
        $title = $item['options']['title'] ?? (is_string($item) ? $item : '');
        $url = (isset($item['url'])) ? Url::toRoute($item['url']) : '#';

        $r = '';

        if (is_string($item)) {
            $r .= $item;
        }
        else if (isset($item['items'])) {
            foreach ($item['items'] as $b) {
                $r .= self::createGridIcon($b, "{$label} - ");
            }
        } else {
            $r = '<div class="col-sm-3 my-2 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">' . "{$parent}" . $label.'</h5>
                        <p class="card-text">'.$title.'</p>
                        <a href="'.$url.'" class="btn btn-outline-primary">Continuar</a>
                    </div>
                </div>
            </div>';
        }

        return $r;
    }
}