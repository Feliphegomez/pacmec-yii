<?php

/** @var yii\web\View $this */
/** @var app\models\MovementsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
use yii\grid\ActionColumn;
use yii\grid\GridView;
// use \kartik\grid\GridView;
// use \kartik\export\ExportMenu;

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
        <div class="form-floating my-3">
            
            <?php 
                // echo ExportMenu::widget([
                //     'dataProvider' => $dataProvider,
                //     'columns' => [
                //         'id',
                //         'plate',
                //         'type.name', // Accede al nombre del tipo a través de la relación
                //         'check_in',
                //         'checkInUser.username',
                //         'check_out',
                //         'checkOutUser.username',
                //         'payment_value',
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
            ?>
            
            <div class="table-responsive">
                <?= 
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    // 'filterModel' => $searchModel,
                    'columns' => [
                        // ['class' => 'yii\grid\SerialColumn'],
        
                        'id',
                        [
                            'label' => 'Detalle (Ejm. Placa)',
                            'value' => function($model) {
                                return $model->plate;
                            },
                        ],
                        'type.name',
                        // [
                        //     'label' => 'Tipo',
                        //     'value' => function($model) {     // render your custom button
                        //         return $model->type->name;
                        //     }
                        // ],
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
                    ],
                ]); ?>
                
                <table class="table table-striped table-bordered">
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-end">Total</th>
                            <th colspan="1"><?= json_encode($total) ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
	</div>
</div>
