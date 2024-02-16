<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\sparking\models\MovementSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="movement-search">

    <?php $form = ActiveForm::begin([
        // 'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <!-- <div class="col-md-4">
            <?= $form->field($model, 'id') ?>
        </div> -->
        <div class="col-md-6">
            <?= $form->field($model, 'plate') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'check_out_user_id')->textInput()->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\User::find()->andWhere('status = 10')->all(), 'id', 'username'), ['prompt' => 'Seleccione una opcion']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'check_out_desde') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'check_out_hasta') ?>
        </div>
    </div>
    <?php // echo $form->field($model, 'id') ?>
    <?php // echo $form->field($model, 'plate') ?>
    <?php // echo $form->field($model, 'type_id') ?>
    <?php // echo $form->field($model, 'check_in') ?>
    <?php // echo $form->field($model, 'check_in_user_id') ?>
    <?php // echo $form->field($model, 'check_out') ?>
    <?php // echo $form->field($model, 'check_out_user_id') ?>
    <?php // echo $form->field($model, 'time_elapsed') ?>
    <?php // echo $form->field($model, 'payment_value') ?>

    <div class="form-group py-3">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary w-100']) ?>
        <?php // echo Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>