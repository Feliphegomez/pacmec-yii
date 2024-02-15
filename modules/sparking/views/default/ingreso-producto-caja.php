<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'Producto caja';
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
  <div class="row align-items-center g-lg-5 py-3">
    <div class="col-lg-8 text-center text-lg-start mx-auto">
      <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3 text-center">Producto de caja</h1>
      <p class="text-center fs-4">Utilice el formulario para reportar un producto vendido en caja.</p>
        <?php if ($addId): ?>
            <div class="alert alert-success">Registrado con exitoso!</div>
        <?php endif ?>
        <?php $form = ActiveForm::begin(['id' => 'producto-caja-form']); ?>
            <?= $form->field($model, 'plate')->radioList(
                \yii\helpers\ArrayHelper::map($productos, 'id', 'name'),
            )->label("Producto")->label(false); ?>
            <div class="form-group">
                <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary w-100', 'name' => 'contact-button']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>

<?php if ($addId): ?>
<script>
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