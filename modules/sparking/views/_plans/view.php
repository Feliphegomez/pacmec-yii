<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Plans $model */

$this->title = "Membresia # {$model->id}";
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = ['label' => 'Miembros', 'url' => ['/sparking/plans']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="plans-view">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?php // Html::a('Editar', ['/sparking/plans/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Eliminar', ['/sparking/plans/delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'plate',
                'type_id',
                'membership_id',
                'date_start',
                'date_end',
            ],
        ]) ?>
    </div>
</div>
