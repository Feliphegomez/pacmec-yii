<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MovementsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="movements-search">
    <?php $form = ActiveForm::begin([
        // 'action' => ['site/salida-vehiculo'],
        'method' => 'get',
        'options' => [
            // 'class' => 'p-4 p-md-4 border rounded-3 bg-body-tertiary',
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'id') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'plate') ?>
        </div>
    </div>
    <?php // $form->field($model, 'type_id') ?>
    <?php // $form->field($model, 'check_in') ?>
    <?php // $form->field($model, 'check_in_user_id') ?>
    <?php // echo $form->field($model, 'check_out') ?>
    <?php // echo $form->field($model, 'check_out_user_id') ?>
    <?php // echo $form->field($model, 'time_elapsed') ?>
    <?php // echo $form->field($model, 'payment_value') ?>
    <div class="form-group d-grid gap-2">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-outline-primary']) ?>
        <!-- <?= Html::resetButton('Limpiar', ['class' => 'btn btn-outline-secondary', 'type' => 'reset']) ?> -->
        <!-- <a class="btn btn-info" href="<?= Url::toRoute(['site/salida-vehiculo']) ?>">Limpiar</a> -->
    </div>
    <?php ActiveForm::end(); ?>
</div>
