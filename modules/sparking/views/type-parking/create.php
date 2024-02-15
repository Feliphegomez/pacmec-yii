<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\sparking\models\TypeParking $model */

$this->title = 'Nuevo tipo de estacionamiento';
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = ['label' => 'Tipos de estacionamientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-parking-create">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
