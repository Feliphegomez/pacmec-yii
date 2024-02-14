<?php 
namespace app\modules\hello;

class HelloModule extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        // inicializa el módulo con la configuración cargada desde config.php
        \Yii::configure($this, require __DIR__ . '/config.php');
        \Yii::$app->params['menus']['admin'][] = [
            'label' => '<i class="bi bi-people"></i> Hello!',
            'url' => ['/hello/test'],
            // 'linkOptions' => ['class' => 'nav-link link-body-emphasis px-2'],
        ];
        // ...  otro código de inicialización ...
    }
}