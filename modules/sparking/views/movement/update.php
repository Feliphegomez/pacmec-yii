<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\sparking\models\Movement $model */

$this->title = "Movimiento #{$model->id} - Placa: {$model->plate}";
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = ['label' => 'Movimientos - Admin', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Movimiento #{$model->id} - Placa: {$model->plate}", 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="movement-update">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
