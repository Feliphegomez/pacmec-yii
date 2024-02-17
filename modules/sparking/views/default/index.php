<?php

use app\modules\sparking\models\Menus;
use yii\helpers\Url;

$this->title = 'SParking';
// $this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = $this->title;
$items = array_merge(Menus::getMenuPrimary(), Menus::getMenuPrimaryExtra());
?>
<div class="container text-center my-2">
    <div class="row">
        <?php foreach ($items as $item) : ?>
            <div class="col-sm-3 my-2 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $item['label'] ?></h5>
                        <p class="card-text"><?= $item['options']['title'] ?? '' ?></p>
                        <a href="<?= Url::toRoute($item['url']) ?>" class="btn btn-outline-primary">Continuar</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>