<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Movement $model */

$this->title = 'Nuevo miembro';
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
// $this->params['breadcrumbs'][] = ['label' => 'Miembros', 'url' => ['/sparking/members']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
  <div class="row align-items-center g-lg-5 py-3">
    <div class="col-lg-8 mx-auto">
      <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3 text-center">Plan/Membresia</h1>
      <p class="text-center fs-4  ">Utilice el formulario para agregar un nuevo miembro, Si el vehiculo ya cuenta con una membresia te informaremos.</p>
        <?php if ($addId): ?>
            <div class="alert alert-success">La membresía se cargo con exitoso!</div>
            <p>
            <div class="d-grid gap-2 col-10 mx-auto">
                <a class="btn btn-outline-primary" href="#" onclick="javascript:openTicketById()">Imprimir comprobante</a>
            </div>
            </p>
        <?php endif ?>
        <?= $this->render('/plan/_form-min', [
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
    let url = '<?= Url::toRoute(['site/voucher-plan', 'id' => $addId]) ?>';
    console.log('OK', url)
    window.open(
      url,
      'winname',
      'directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=400,height=350'
    );
  }
  </script>
<?php endif ?>