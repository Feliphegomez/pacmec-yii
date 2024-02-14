<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Mis ajustes';
$this->params['breadcrumbs'][] = ['label' => 'Mi perfil', 'url' => ['profile']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-settings container">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Manten tus datos actualizados:</p>
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'form-settings']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    <a href="<?= Url::toRoute(['/site/profile']) ?>" class="btn btn-secondary">Cancelar</a>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>