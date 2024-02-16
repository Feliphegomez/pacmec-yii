<?php

/** @var yii\web\View $this */
/** @var app\models\MovementsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

use app\modules\sparking\helpers\Badge;
use app\modules\sparking\models\TypeParking;
use yii\grid\ActionColumn;
// use yii\grid\GridView;
use kartik\export\ExportMenu;
use kartik\icons\FontAwesomeAsset;
use yii\bootstrap5\Html;
use yii\helpers\Url;

FontAwesomeAsset::register($this);

$this->title = 'Reporte';
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = $this->title;

$total = 0;
foreach ($dataProvider->models as $m) {
    $total += $m->payment_value;
}
?>
<div class="movements-index">
    <div class="container">
        <?php //$this->render('/movements/_search.php', [ 'model' => $searchModel, ]); ?>
        <h1><?= Html::encode($this->title) ?></h1>
        <?= (isset($searchFormEnable) && $searchFormEnable) ? $this->render('/movement/_search', ['model' => $searchModel]) : ''; ?>
        <div class="form-floating my-3">
            <?php 
                $gridColumns = [
                    ['class' => 'yii\grid\SerialColumn'],
                    
                    // 'id',
                    [
                        'label'=>'Placa',
                        'attribute'=>'plate',
                        'value'=>'plate',
                    ],
                    [
                        'label'=>'T. vehiculo',
                        'filter'=>\yii\helpers\ArrayHelper::map(TypeParking::find()->all(), 'id', 'name'),
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
                    // [
                    //     'class' => 'yii\grid\ActionColumn',
                    //     // 'template' => '{view} {update} {delete} {myButtonView}',  // the default buttons + your custom button
                    //     'template' => Yii::$app->user->can('admin') ? '{myButtonView} {myButtonOuting} {myButtonPrintVoucher} {myButtonPrintTicket}' : '',
                    //     'buttons' => [
                    //         'myButtonView' => function($url, $model, $key) {     // render your custom button
                    //             return Html::a('Detalles', Url::toRoute(['/sparking/default/ticket-details', 'id' => $model->id]), ['class'=>'btn btn-primary btn-sm']);
                    //         },
                    //         'myButtonPrintTicket' => function($url, $model, $key) {     // render your custom button
                    //             return Html::a('Ticket Entrada', Url::toRoute(['/sparking/default/ticket-in', 'id' => $model->id]), ['class'=>'btn btn-info btn-sm', 'target' => '_blank']);
                    //         },
                    //         'myButtonPrintVoucher' => function($url, $model, $key) {     // render your custom button
                    //             return (empty($model->check_out)) ? '' : Html::a('Ticket Salida', Url::toRoute(['/sparking/default/ticket-out', 'id' => $model->id]), ['class'=>'btn btn-info btn-sm', 'target' => '_blank']);
                    //         },
                    //         'myButtonOuting' => function($url, $model, $key) {     // render your custom button
                    //             return (!empty($model->check_out)) ? '' : Html::a('Registrar Salida', Url::toRoute(['/sparking/default/salida-vehiculo', 'id' => $model->id]), ['class'=>'btn btn-warning btn-sm']);
                    //         },
                    //     ]
                    // ],
                ];
                
                // Renders a export dropdown menu
                echo ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                    'dropdownOptions' => [
                        'label' => 'Exportar',
                    ],
                ]);
            ?>
            <div class="pt-3">
                <table class="table table-striped table-bordered">
                    <tbody>
                        <?php if ($searchModel->check_out_desde && $searchModel->check_out_hasta) : ?>
                            <tr>
                                <td class="text-end">Fecha (desde):</td>
                                <td><?= $searchModel->check_out_desde ?></td>
                            </tr>
                            <tr>
                                <td class="text-end">Fecha (hasta):</td>
                                <td><?= $searchModel->check_out_hasta ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($searchModel->check_out_user_id) : ?>
                            <tr>
                                <td class="text-end">Solo Usuario:</td>
                                <td><?= $searchModel->checkOutUser->username ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-end">Total</th>
                            <th><?= Yii::$app->formatter->asCurrency($searchModel->totalSum, 'COP') ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <?php 
                // You can choose to render your own GridView separately
                echo \kartik\grid\GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $gridColumns
                ]);
            ?>
        </div>
	</div>
</div>
