<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\sparking\models\Movement $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="movement-form">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'plate')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'type_id')->textInput() ?>
        <?= $form->field($model, 'check_in')->textInput() ?>
        <?= $form->field($model, 'check_in_user_id')->textInput() ?>
        <?= $form->field($model, 'check_out')->textInput() ?>
        <?= $form->field($model, 'check_out_user_id')->textInput() ?>
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
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
