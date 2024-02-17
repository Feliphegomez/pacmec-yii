<?php

use app\modules\sparking\helpers\Badge;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Movements $model */

$this->title = "Movimiento # {$model->id}";
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Actividad', 'url' => ['activity']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="movements-view">
    <div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>
    </div>
</div>