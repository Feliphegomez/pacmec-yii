<?php

use app\models\Movements;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
// use yii\grid\GridView;
use \kartik\grid\GridView;
use \kartik\export\ExportMenu;

/** @var yii\web\View $this */
/** @var app\models\MovementsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Movimientos';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="movements-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><!-- <?= Html::a('Create Movements', ['create'], ['class' => 'btn btn-success']) ?> --></p>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php 
        echo ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'plate',
                'type.name', // Accede al nombre del tipo a través de la relación
                'check_in',
                'checkInUser.username',
                'check_out',
                'checkOutUser.username',
                'payment_value',
            ],
            'dropdownOptions' => [
                'label' => 'Exportar',
                'class' => 'btn btn-secondary',
            ],
            'exportConfig' => [
                ExportMenu::FORMAT_HTML => false,
                ExportMenu::FORMAT_TEXT => false,
                ExportMenu::FORMAT_PDF => false,
                ExportMenu::FORMAT_EXCEL => false,
                ExportMenu::FORMAT_CSV => [
                    'label' => 'CSV',
                ],
            ],
        ]);
        
        echo GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'plate',
            [
                'label' => 'Placa',
                'value' => function($model) {
                    return strtoupper($model->plate);
                }
            ],
            'type.name',
            'check_in',
            'checkInUser.username',
            'check_out',
            //'check_out',
            //'check_out_user_id',
            //'time_elapsed:datetime',
            //'payment_value',
            //'payment_value',
			'checkOutUser.username',
			'payment_value',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Movements $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                    return $action == 'delete' ? Url::toRoute([$action, 'id' => $model->id]) : '';
                 }
            ],
        ],
    ]);
    ?>


</div>
