<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Movements $model */

$this->title = "Movimiento # {$model->id}";
$this->params['breadcrumbs'][] = ['label' => 'Movements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="movements-view">
    <div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php // Html::a('Editar', ['/sparking/default/salida-vehiculo', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['/sparking/movements/delete', 'id' => $model->id], [
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
            'check_in',
            'check_in_user_id',
            'check_out',
            'check_out_user_id',
            // 'time_elapsed:datetime',
            'payment_value',
        ],
    ]) ?>
    </div>
</div>