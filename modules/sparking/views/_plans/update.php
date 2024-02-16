<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Plans $model */

$this->title = "Membresia # {$model->id}";
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = ['label' => 'Miembros', 'url' => ['/sparking/plans']];
$this->params['breadcrumbs'][] = $this->title . " - Editando";
?>
<div class="plans-update">
    <div class="container">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
