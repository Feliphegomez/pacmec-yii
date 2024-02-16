<?php

use app\modules\sparking\models\TypeParking;
use app\modules\sparking\helpers\Badge;
use yii\helpers\Html;
use yii\helpers\Url;
// use yii\grid\GridView;
use kartik\export\ExportMenu;

// on your view layout file
use kartik\icons\FontAwesomeAsset;

FontAwesomeAsset::register($this);

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Actividad';
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movement-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?php 
                if (Yii::$app->user->can('cashier')) {
                    echo Html::a('Registrar Ingreso', ['/sparking/default/ingreso-vehiculo'], ['class' => 'btn btn-success']);
                }
            ?>
        </p>
        <?php 
            $gridColumns = [
                // ['class' => 'yii\grid\SerialColumn'],
                // 'id',
                ['class' => 'yii\grid\SerialColumn'],
                
                // 'id',
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
                // [
                //     'class' => ActionColumn::className(),
                //     'urlCreator' => function ($action, Movement $model, $key, $index, $column) {
                //         return Url::toRoute(["/sparking/movement/{$action}", 'id' => $model->id]);
                //     }
                // ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    // 'template' => '{view} {update} {delete} {myButtonView}',  // the default buttons + your custom button
                    'template' => Yii::$app->user->can('admin') ? '{myButtonView} {myButtonOuting} {myButtonPrintVoucher} {myButtonPrintTicket}' : '',
                    'buttons' => [
                        'myButtonView' => function($url, $model, $key) {     // render your custom button
                            return Html::a('Detalles', Url::toRoute(['/sparking/default/ticket-details', 'id' => $model->id]), ['class'=>'btn btn-primary btn-sm']);
                        },
                        'myButtonPrintTicket' => function($url, $model, $key) {     // render your custom button
                            return Html::a('Ticket Entrada', Url::toRoute(['/sparking/default/ticket-in', 'id' => $model->id]), ['class'=>'btn btn-info btn-sm', 'target' => '_blank']);
                        },
                        'myButtonPrintVoucher' => function($url, $model, $key) {     // render your custom button
                            return (empty($model->check_out)) ? '' : Html::a('Ticket Salida', Url::toRoute(['/sparking/default/ticket-out', 'id' => $model->id]), ['class'=>'btn btn-info btn-sm', 'target' => '_blank']);
                        },
                        'myButtonOuting' => function($url, $model, $key) {     // render your custom button
                            return (!empty($model->check_out)) ? '' : Html::a('Registrar Salida', Url::toRoute(['/sparking/default/salida-vehiculo', 'id' => $model->id]), ['class'=>'btn btn-warning btn-sm']);
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
