<?php

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