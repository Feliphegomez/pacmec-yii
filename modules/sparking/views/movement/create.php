<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\sparking\models\Movement $model */

$this->title = 'Create Movement';
$this->params['breadcrumbs'][] = ['label' => 'Movements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movement-create">

    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>