<?php

use app\modules\sparking\models\Plan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\sparking\models\PlanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Miembros - Admin';
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?= Html::a('Creacion manual', ['/sparking/plan/create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Creacion normal', ['/sparking/default/ingreso-plan'], ['class' => 'btn btn-success']) ?>
        </p>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'plate',
                'type_id',
                'membership_id',
                'date_start',
                'date_end',
                // 'payment_value',
                [
                    'label'=>'Cobro',
                    'format' => 'html',
                    'attribute'=>'payment_value',
                    'value'=> function($model) {
                        return (!empty($model->payment_value)) ? Yii::$app->formatter->asCurrency($model->payment_value, 'COP') : 'Pdte';
                    },
                    // 'value'=>Yii::$app->numberFormatter->formatCurrency(, "COP"),
                ],
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Plan $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    </div>
</div>
