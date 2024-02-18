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
                    'label' => '<i class="bi bi-people"></i> Miembros',
                    'url' => ['/sparking/plan/index'],
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