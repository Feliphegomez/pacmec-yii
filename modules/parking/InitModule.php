<?php 
namespace app\modules\parking;

class InitModule extends \yii\base\Module
{
    public function init()
    {
        \Yii::configure($this, require __DIR__ . '/config.php');
        parent::init();

        if (\Yii::$app->user->can('admin') || \Yii::$app->user->can('cashier')) {
            // \Yii::$app->params['menus']['top_primary'][] = [
            //     'label' => '<i class="bi bi-p-square-fill d-none d-lg-block mx-auto mb-1" style="font-size: 1.5rem; color: cornflowerblue; text-align:center;"></i> Parqueadero',
            //     'url' => ['/sparking/default'],
            // ];
        }
        
        \Yii::$app->params['menus']['admin'] = array_merge(\Yii::$app->params['menus']['admin'], [
            '<hr class="dropdown-divider">',
            [
                'label' => 'Parqueadero',
                // 'linkOptions' => ['class' => 'nav-link link-body-emphasis px-2'],
            ],
            [
                'label' => '<i class="bi bi-people"></i> Movimientos',
                'url' => ['/parking/admin/index'],
                // 'linkOptions' => ['class' => 'nav-link link-body-emphasis px-2'],
            ],
            [
                'label' => '<i class="bi bi-people"></i> Miembros',
                'url' => ['/parking/admin/members'],
                // 'linkOptions' => ['class' => 'nav-link link-body-emphasis px-2'],
            ],
            [
                'label' => '<i class="bi bi-people"></i> Membresias',
                'url' => ['/parking/admin/memberships'],
                // 'linkOptions' => ['class' => 'nav-link link-body-emphasis px-2'],
            ],
            [
                'label' => '<i class="bi bi-people"></i> Tarifas',
                'url' => ['/parking/admin/fees'],
                // 'linkOptions' => ['class' => 'nav-link link-body-emphasis px-2'],
            ],
            [
                'label' => '<i class="bi bi-people"></i> Configurar',
                'url' => ['/parking/admin/settings'],
                // 'linkOptions' => ['class' => 'nav-link link-body-emphasis px-2'],
                'visible' => \Yii::$app->user->can('admin'),
            ],
        ]);
    }
}