<?php

use app\models\Movement;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Movement $model */
/** @var app\models\MovementSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Salida de vehiculo';
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row align-items-center g-lg-5 py-3">
        <div class="<?= (empty($model)) ? 'col-lg-5' : 'col-lg-12' ?> text-center mx-auto text-lg-start">
            <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3 text-center">Salida de Vehículo</h1>
            <?php if (empty($model)) : ?>
                <p class="text-center">Utilice el buscador para los encontrar el vejículo, la informacion se visualizara despues de esto.</p>
                <?= $this->render('/movement/_search-min', [
                    'model' => $searchModel,
                ]) ?>
            <?php else : ?>
                <p class="text-center fs-5">Confirme los datos del vehiculo antes de registrar la salida.</p>
            <?php endif; ?>
        </div>

        <div class="col-lg-7 mx-auto">
            <?php if ($outId): ?>
                <div class="alert alert-success">Salida del vehiculo exitoso!</div>
                <p>
                    <div class="d-grid gap-2 col-10 mx-auto">
                        <a class="btn btn-info" href="#" onclick="javascript:openTicketById()">Imprimir comprobante</a>
                    </div>
                </p>
            <?php endif ?>
            <?= $model ? $this->render('/movement/_form-auto', [
                'model' => $model,
                'payment_time' => $payment_time,
            ]) : GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'plate',
                    // 'type_id',
                    [
                        'label' => 'Tipo',
                        'value' => function($model) {     // render your custom button
                            return $model->type->name;
                        }
                    ],
                    'check_in',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        // 'template' => '{view} {update} {delete} {myButton}',  // the default buttons + your custom button
                        'template' => '{myButton}',
                        'buttons' => [
                            'myButton' => function($url, $model, $key) {     // render your custom button
                                return Html::a('Continuar', Url::toRoute(['/sparking/default/salida-vehiculo', 'id' => $model->id]), ['class'=>'btn btn-primary btn-xs']);
                            }
                        ]
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>

<?php if ($outId): ?>
  <script>
  function openTicketById() 
  {
    let url = '<?= Url::toRoute(['/sparking/default/ticket-out', 'id' => $outId]) ?>';
    console.log('OK', url)
    window.open(
      url,
      'winname',
      'directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=400,height=350'
    );
  }
  </script>
<?php endif ?>