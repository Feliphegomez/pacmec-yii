<?php

use app\modules\sparking\models\Membership;
use app\modules\sparking\models\TypeParking;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\sparking\models\Plan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="plan-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'plate')->textInput(['maxlength' => true]) ?>
    <?php echo $form->field($model, 'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(TypeParking::find()->all(), 'id', 'name'), ['prompt' => 'Seleccione Uno' ]); ?>
    <?php echo $form->field($model, 'membership_id')->dropDownList(\yii\helpers\ArrayHelper::map(Membership::find()->all(), 'id', 'name'), ['prompt' => 'Seleccione Uno' ]); ?>
    <?= $form->field($model, 'date_start')->textInput() ?>
    <?= $form->field($model, 'date_end')->textInput() ?>
    <?= $form->field($model, 'payment_value')->textInput(['maxlength' => true]) ?>

    <div class="form-group py-3">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success w-100']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
