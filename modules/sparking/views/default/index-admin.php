<?php

use app\modules\sparking\models\Menus;
use yii\helpers\Url;

$this->title = 'SParking';
// $this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = $this->title;
$items = array_merge(Menus::getMenuPrimary(), Menus::getMenuPrimaryExtra(), Menus::getMenuAdmin());
// $items = Menus::getMenuAdmin();
?>
<div class="container text-center my-2">
    <div class="row">
        <?php 
            foreach ($items as $item) {
                echo Menus::createGridIcon($item);
            }
        ?>
    </div>
</div>