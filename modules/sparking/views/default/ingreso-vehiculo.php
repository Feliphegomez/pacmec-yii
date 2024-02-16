<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Movements $model */

$this->title = 'Ingreso de vehiculo';
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = ['label' => 'Actividad', 'url' => ['/sparking/default/activity']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row align-items-center g-lg-5 py-3">
        <div class="col-lg-8 mx-auto">
            <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3 text-center">Ingreso de Vehículo</h1>
            <p class="text-center fs-4">Rellene los campos para realizar el ingreso del vehiculo.</p>
            <?php if ($addId): ?>
                <div class="alert alert-success">Ingreso del vehiculo exitoso!</div>
                <p>
                    <div class="d-grid gap-2 col-10 mx-auto">
                        <a class="btn btn-info" href="#" onclick="javascript:openTicketById()">Imprimir comprobante</a>
                    </div>
                </p>
            <?php endif ?>
            <?= $this->render('/movement/_form-auto', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>

<?php if ($addId): ?>
<script>
  function openTicketById() 
  {
    let url = '<?= Url::toRoute(['/sparking/default/ticket-in', 'id' => $addId]) ?>';
    console.log('OK', url)
    window.open(
      url,
      'winname',
      'directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=324,height=550'
    );
  }
</script>
<?php endif ?>