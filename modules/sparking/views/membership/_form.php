<?php

use app\modules\sparking\models\TypeParking;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\sparking\models\Membership $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="membership-form">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'type_id')->radioList(
            \yii\helpers\ArrayHelper::map(TypeParking::find()->andWhere('id > 1')->all(), 'id', 'name'), []
        ); ?>
        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        <?php // echo $form->field($model, 'duration')->textInput() ?>
        <?php echo $form->field($model, 'duration[f]')->textInput()->label("Milisegundos") ?>
        <?php echo $form->field($model, 'duration[s]')->textInput()->label("Segundos") ?>
        <?php echo $form->field($model, 'duration[i]')->textInput()->label("Minutos") ?>
        <?php echo $form->field($model, 'duration[h]')->textInput()->label("Horas") ?>
        <?php echo $form->field($model, 'duration[d]')->textInput()->label("Dias") ?>
        <?php echo $form->field($model, 'duration[m]')->textInput()->label("Meses") ?>
        <?php echo $form->field($model, 'duration[y]')->textInput()->label("Años") ?>
    <div class="form-group py-3">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success w-100']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>