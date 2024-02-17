<?php

use app\modules\sparking\models\Movement;
use app\modules\sparking\models\TypeParking;
use app\modules\sparking\helpers\Badge;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\export\ExportMenu;
use kartik\icons\FontAwesomeAsset;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Movimientos - Admin';
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = $this->title;

FontAwesomeAsset::register($this);
?>
<div class="movement-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?php 
                if (Yii::$app->user->can('admin')) {
                    echo Html::a('Crear actividad', ['/sparking/movement/create'], ['class' => 'btn btn-success']);
                }
            ?>
            <?php 
                if (Yii::$app->user->can('cashier')) {
                    echo Html::a('Ingreso normal', ['/sparking/default/ingreso-vehiculo'], ['class' => 'btn btn-success']);
                }
            ?>
        </p>
        <?php 
            $gridColumns = [
                // ['class' => 'yii\grid\SerialColumn'],
                'id',
                [
                    'label'=>'Placa',
                    'attribute'=>'plate',
                    'value'=>'plate',
                ],
                [
                    'label'=>'T. vehiculo',
                    'filter'=>\yii\helpers\ArrayHelper::map(TypeParking::find()->andWhere('id > 1')->all(), 'id', 'name'),
                    'attribute'=>'type_id',
                    'value'=>'type.name',
                ],
                [
                    'label'=>'Fecha de Ingreso',
                    'format' => ['datetime', 'php:Y-m-d H:i'],
                    'attribute'=>'check_in',
                    'value'=>'check_in',
                ],
                [
                    'label'=>'Ingreso por',
                    'filter'=>\yii\helpers\ArrayHelper::map(\app\models\User::find()->andWhere('status = 10')->all(), 'id', 'username'),
                    'attribute'=>'check_in_user_id',
                    'value'=>'checkInUser.username',
                ],
                [
                    'label'=>'Fecha de Salida',
                    'format' => ['datetime', 'php:Y-m-d H:i'],
                    'attribute'=>'check_out',
                    'value'=>'check_out',
                ],
                [
                    'label'=>'Salida por',
                    'filter'=>\yii\helpers\ArrayHelper::map(\app\models\User::find()->andWhere('status = 10')->all(), 'id', 'username'),
                    'attribute'=>'check_out_user_id',
                    'value'=>'checkOutUser.username',
                ],
                [
                    'label'=>'Tiempo transcurrido',
                    'attribute'=>'time_elapsed',
                    'format'=>'html',
                    // 'encodeLabel' => false,
                    'value'=> function($model) {
                        return Badge::JsonToString($model->time_elapsed);
                    },
                ],
                //'time_elapsed',
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
                    'class' => ActionColumn::class,
                    // 'buttonOptions' => [
                    //     'class' => 'btn btn-sm btn-primary',
                    // ],
                    'urlCreator' => function ($action, Movement $model, $key, $index, $column) {
                        return Url::toRoute(["/sparking/movement/{$action}", 'id' => $model->id]);
                    }
                ],
            ];
            
            // Renders a export dropdown menu
            echo ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
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
