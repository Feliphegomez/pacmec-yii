<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\modules\sparking\models\Plans;

// use \kartik\grid\GridView;
// use \kartik\export\ExportMenu;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Miembros';
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plans-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="table-responsive">

            <?php 
                // echo ExportMenu::widget([
                //     'dataProvider' => $dataProvider,
                //     'columns' => [
                //         'id',
                //         'plate',
                //         'type.name', // Accede al nombre del tipo a través de la relación
                //         'check_in',
                //         'check_in_user_id',
                //     ],
                //     'dropdownOptions' => [
                //         'label' => 'Exportar',
                //         'class' => 'btn btn-secondary',
                //     ],
                //     'exportConfig' => [
                //         ExportMenu::FORMAT_HTML => false,
                //         ExportMenu::FORMAT_TEXT => false,
                //         ExportMenu::FORMAT_PDF => false,
                //         ExportMenu::FORMAT_EXCEL => false,
                //         ExportMenu::FORMAT_CSV => [
                //             'label' => 'CSV',
                //         ],
                //     ],
                // ]);
                echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'id',
                    'plate',
                    // 'type_id',
                    // 'membership_id',
                    [
                        'label' => 'Tipo',
                        'value' => function($model) {     // render your custom button
                            return $model->type->name;
                        }
                    ],
                    [
                        'label' => 'Plan',
                        'value' => function($model) {     // render your custom button
                            return $model->membership->name;
                        }
                    ],
                    'date_start',
                    'date_end',
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
                                return Html::a('Detalles', Url::toRoute(['/sparking/plans/view', 'id' => $model->id]), ['class'=>'btn btn-primary btn-xs']);
                            },
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
