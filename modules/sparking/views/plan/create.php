<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\sparking\models\Plan $model */

$this->title = 'Creacion manual';
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = ['label' => 'Miembros - Admin', 'url' => ['/sparking/plan/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-create">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>>
    </div>
</div>
