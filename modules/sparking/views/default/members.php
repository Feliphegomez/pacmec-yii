<?php

use app\modules\sparking\models\Membership;
use app\modules\sparking\models\Plan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
// use yii\grid\GridView;
use kartik\export\ExportMenu;
use app\modules\sparking\models\Plans;
use app\modules\sparking\models\TypeParking;
use kartik\icons\FontAwesomeAsset;

FontAwesomeAsset::register($this);

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Miembros';
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plans-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?php 
                if (Yii::$app->user->can('cashier')) {
                    echo Html::a('Registrar Miembro', ['/sparking/default/ingreso-plan'], ['class' => 'btn btn-success']);
                }
            ?>
        </p>
        <?php 
            $gridColumns = [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'plate',
                // 'type_id',
                // 'membership_id',
                [
                    'label'=>'T. vehiculo',
                    'filter'=>\yii\helpers\ArrayHelper::map(TypeParking::find()->andWhere('id > 1')->all(), 'id', 'name'),
                    'attribute'=>'type_id',
                    'value'=>'type.name',
                ],
                [
                    'label'=>'Membresia',
                    'filter'=>\yii\helpers\ArrayHelper::map(Membership::find()->andWhere('id > 1')->all(), 'id', 'name'),
                    'attribute'=>'membership_id',
                    'value'=>'membership.name',
                ],
                [
                    'label'=>'Fecha de inicio',
                    'format' => ['datetime', 'php:Y-m-d H:i'],
                    'attribute'=>'date_start',
                    'value'=>'date_start',
                ],
                [
                    'label'=>'Fecha de culminacion',
                    'format' => ['datetime', 'php:Y-m-d H:i'],
                    'attribute'=>'date_end',
                    'value'=>'date_end',
                ],
                [
                    'label'=>'Cobro',
                    // 'format' => ['datetime', 'php:Y-m-d H:i'],
                    'attribute'=>'payment_value',
                    'value'=> function($model) {
                        return Yii::$app->formatter->asCurrency($model->payment_value, 'COP');
                    },
                    // 'value'=>Yii::$app->numberFormatter->formatCurrency(, "COP"),
                ],
                // [
                //     'class' => ActionColumn::className(),
                //     'urlCreator' => function ($action, Plans $model, $key, $index, $column) {
                //         return Url::toRoute([$action, 'id' => $model->id]);
                //      }
                // ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    // 'template' => '{view} {update} {delete} {myButton}',  // the default buttons + your custom button
                    'template' => '{myButtonView}',
                    'buttons' => [
                        'myButtonView' => function($url, $model, $key) {     // render your custom button
                            return Html::a('Detalles', Url::toRoute(['/sparking/default/member-detail', 'id' => $model->id]), ['class'=>'btn btn-primary btn-xs']);
                        },
                    ]
                ],
            ];
            
            // Renders a export dropdown menu
            echo ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
                'dropdownOptions' => [
                    'label' => 'Exportar',
                ],
            ]);
            
            // You can choose to render your own GridView separately
            echo \kartik\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $gridColumns
            ]);
        ?>
    </div>
</div>
