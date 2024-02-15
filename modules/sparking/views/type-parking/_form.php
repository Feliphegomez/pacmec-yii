<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\sparking\models\TypeParking $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="type-parking-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?php // echo $form->field($model, 'prices')->textInput() ?>
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Fraccion</th>
                <th scope="col">Precio</th>
                <th scope="col">Max tiempo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Milisegundos</th>
                <td><?php echo $form->field($model, 'prices[f][f]')->textInput()->label(false) ?></td>
                <td><?php echo $form->field($model, 'prices[f][price]')->textInput()->label(false) ?></td>
                <td><?php echo $form->field($model, 'prices[f][max]')->textInput()->label(false) ?></td>
            </tr>
            <tr>
                <th scope="row">Segundos</th>
                <td><?php echo $form->field($model, 'prices[s][f]')->textInput()->label(false) ?></td>
                <td><?php echo $form->field($model, 'prices[s][price]')->textInput()->label(false) ?></td>
                <td><?php echo $form->field($model, 'prices[s][max]')->textInput()->label(false) ?></td>
            </tr>
            <tr>
                <th scope="row">Minutos</th>
                <td><?php echo $form->field($model, 'prices[i][f]')->textInput()->label(false) ?></td>
                <td><?php echo $form->field($model, 'prices[i][price]')->textInput()->label(false) ?></td>
                <td><?php echo $form->field($model, 'prices[i][max]')->textInput()->label(false) ?></td>
            </tr>
            <tr>
                <th scope="row">Horas</th>
                <td><?php echo $form->field($model, 'prices[h][f]')->textInput()->label(false) ?></td>
                <td><?php echo $form->field($model, 'prices[h][price]')->textInput()->label(false) ?></td>
                <td><?php echo $form->field($model, 'prices[h][max]')->textInput()->label(false) ?></td>
            </tr>
            <tr>
                <th scope="row">Dias</th>
                <td><?php echo $form->field($model, 'prices[d][f]')->textInput()->label(false) ?></td>
                <td><?php echo $form->field($model, 'prices[d][price]')->textInput()->label(false) ?></td>
                <td><?php echo $form->field($model, 'prices[d][max]')->textInput()->label(false) ?></td>
            </tr>
            <tr>
                <th scope="row">Meses</th>
                <td><?php echo $form->field($model, 'prices[m][f]')->textInput()->label(false) ?></td>
                <td><?php echo $form->field($model, 'prices[m][price]')->textInput()->label(false) ?></td>
                <td><?php echo $form->field($model, 'prices[m][max]')->textInput()->label(false) ?></td>
            </tr>
            <tr>
                <th scope="row">Años</th>
                <td><?php echo $form->field($model, 'prices[y][f]')->textInput()->label(false) ?></td>
                <td><?php echo $form->field($model, 'prices[y][price]')->textInput()->label(false) ?></td>
                <td><?php echo $form->field($model, 'prices[y][max]')->textInput()->label(false) ?></td>
            </tr>
        </tbody>
    </table>
    
    
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success w-100']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
