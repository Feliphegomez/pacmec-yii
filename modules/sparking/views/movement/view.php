<?php

use app\modules\sparking\helpers\Badge;
use app\modules\sparking\models\TypeParking;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\sparking\models\Movement $model */

$this->title = "Movimiento #{$model->id} - Placa: {$model->plate}";
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = ['label' => 'Movimientos - Admin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


$gridColumns = [
    'id',
    [
        'label'=>'Placa',
        'value'=>$model->plate,
    ],
    [
        'label'=>'T. vehiculo',
        'value'=>$model->type->name,
    ],
    [
        'label'=>'Fecha de Ingreso',
        'value'=>$model->check_in,
    ],
    [
        'label'=>'Ingreso por',
        'value'=>$model->checkInUser->username ?? 'Desconocido',
    ],
    [
        'label'=>'Fecha de Salida',
        'value'=>$model->check_out ?? 'Pendiente',
    ],
    [
        'label'=>'Salida por',
        'value'=>(empty($model->check_out_user_id)) ? 'Pendiente' : (empty($model->checkOutUser) ? 'Desconocido' : $model->checkOutUser->username),
    ],
    [
        'label'=>'Tiempo transcurrido',
        'format'=>'html',
        'value'=>Badge::JsonToString($model->time_elapsed),
    ],
    [
        'label'=>'Cobro',
        'value'=> function($model) {
            return (!empty($model->payment_value)) ? Yii::$app->formatter->asCurrency($model->payment_value, 'COP') : 'Pendiente';
        },
    ],
];

?>
<div class="movement-view">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?php  if (Yii::$app->user->can('cashier')) { ?>
                <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php } ?>
            <?php if (Yii::$app->user->can('admin')) { ?>
            <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '¿Estás seguro de que quieres eliminar este artículo?',
                    'method' => 'post',
                ],
            ]) ?>
            <?php } ?>
        </p>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumns,
        ]) ?>
    </div>
</div>
