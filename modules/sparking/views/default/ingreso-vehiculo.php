<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Movements $model */

$this->title = 'Ingreso de vehiculo';
// $this->params['breadcrumbs'][] = ['label' => 'Movements', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="container col-12 px-4 py-5">
  <div class="row align-items-center g-lg-5 py-5">
    <div class="col-lg-6 text-center text-lg-start">
      <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Ingreso de Vehículo</h1>
      <p class="text-center fs-4">Utilice el buscador para los miembros, si desea realizar un ingreso manual utilice le formulario.</p>
      <!-- <form action="/ingreso_vehiculo.php" method="post" name="busqueda" id="busqueda">
        <input class="form-control" name="busquedas" type="text" value="" size="6" maxlength="6" placeholder="Placa del vehículo" />
        <br />
        <div class="d-grid gap-2">
          <button class="btn btn-outline-secondary" type="submit" id="enviar" name="enviar">Buscar</button>
          <button class="btn btn-primary" type="button">Primary action</button>
        </div>
      </form> -->
    </div>
    <div class="col-lg-6 mx-auto">
        <?php if ($addId): ?>
            <div class="alert alert-success">Ingreso del vehiculo exitoso!</div>
            <p>
            <div class="d-grid gap-2 col-10 mx-auto">
                <a class="btn btn-info" href="#" onclick="javascript:openTicketById()">Imprimir comprobante</a>
                <!-- <a class="btn btn-outline-danger" href="<?= Url::toRoute(['site/ingreso-vehiculo']) ?>">Cancelar</a> -->
            </div>
            </p>
        <?php endif ?>
        <?= $this->render('/movements/_form', [
            'model' => $model,
        ]) ?>
    </div>
  </div>
</div>

<?php if ($addId): ?>
  <script>
  // window.addEventListener('load', () => {
  //   console.log('OK')
  // })

  function openTicketById() 
  {
    let url = '<?= Url::toRoute(['site/ticket-in', 'id' => $addId]) ?>';
    console.log('OK', url)
    window.open(
      url,
      'winname',
      'directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=324,height=550'
    );
  }
  </script>
<?php endif ?>