<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\sparking\models\Movement $model */

$this->title = 'Update Movement: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Movements', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="movement-update">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>