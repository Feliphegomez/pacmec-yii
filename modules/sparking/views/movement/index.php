<?php

use app\modules\sparking\models\Movement;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Movimientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movement-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?= Html::a('Nuevo Ingreso', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Ingresar V', ['/sparking/default/ingreso-vehiculo'], ['class' => 'btn btn-success']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'plate',
                [
                    'label' => 'Tipo registro',
                    'value' => 'type.name',
                ],
                'check_in',
                'checkInUser.username',
                //'check_out',
                //'check_out_user_id',
                //'time_elapsed',
                //'payment_value',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Movement $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    </div>
</div>
