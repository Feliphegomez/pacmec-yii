<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\sparking\models\Plan $model */

$this->title = 'Update Plan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = ['label' => 'Miembros', 'url' => ['/sparking/plan/index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="plan-update">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
