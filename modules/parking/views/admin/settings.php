<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\sparking\models\TypeParking $model */

$this->title = 'Configuraciones';
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/parking/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-parking-create">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= $this->render('_form-settings', [
            'model' => $model,
        ]) ?>
    </div>
</div>
