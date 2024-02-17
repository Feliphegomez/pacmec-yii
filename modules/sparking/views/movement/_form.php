<?php

use app\models\User;
use app\modules\sparking\models\TypeParking;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\sparking\models\Movement $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="movement-form">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'plate')->textInput(['maxlength' => true]) ?>
        <?php echo $form->field($model, 'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(TypeParking::find()->all(), 'id', 'name'), ['prompt' => 'Seleccione Uno' ]); ?>
        <?= $form->field($model, 'check_in')->textInput() ?>
        <?php echo $form->field($model, 'check_in_user_id')->dropDownList(\yii\helpers\ArrayHelper::map(User::find()->all(), 'id', 'username'), ['prompt' => 'Seleccione Uno' ]); ?>
        <?= $form->field($model, 'check_out')->textInput() ?>
        <?php echo $form->field($model, 'check_out_user_id')->dropDownList(\yii\helpers\ArrayHelper::map(User::find()->all(), 'id', 'username'), ['prompt' => 'Seleccione Uno' ]); ?>
        <?php // echo $form->field($model, 'time_elapsed')->textInput() ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Milisegundos</th>
                    <th scope="col">Segundos</th>
                    <th scope="col">Minutos</th>
                    <th scope="col">Horas</th>
                    <th scope="col">Dias</th>
                    <th scope="col">Meses</th>
                    <th scope="col">Años</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $form->field($model, 'time_elapsed[f]')->textInput()->label(false) ?></td>
                    <td><?php echo $form->field($model, 'time_elapsed[s]')->textInput()->label(false) ?></td>
                    <td><?php echo $form->field($model, 'time_elapsed[i]')->textInput()->label(false) ?></td>
                    <td><?php echo $form->field($model, 'time_elapsed[h]')->textInput()->label(false) ?></td>
                    <td><?php echo $form->field($model, 'time_elapsed[d]')->textInput()->label(false) ?></td>
                    <td><?php echo $form->field($model, 'time_elapsed[m]')->textInput()->label(false) ?></td>
                    <td><?php echo $form->field($model, 'time_elapsed[y]')->textInput()->label(false) ?></td>
                </tr>
            </tbody>
        </table>
        <?= $form->field($model, 'payment_value')->textInput(['maxlength' => true]) ?>
        <div class="form-group py-3">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success w-100']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
