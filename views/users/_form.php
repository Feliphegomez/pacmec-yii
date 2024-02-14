<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="profile-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php 
        echo $form->field($model, 'email')->textInput(['maxlength' => true]);
        if ($model->scenario == 'create') {
            // echo $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]);
            // echo $form->field($model, 'status')->textInput();
            echo $form->field($model, 'password')->textInput(['maxlength' => true]);

            // echo $form->field($model, 'created_at')->textInput();
            // echo $form->field($model, 'updated_at')->textInput();
            // echo $form->field($model, 'verification_token')->textInput(['maxlength' => true]);
        }
        else if ($model->scenario == 'update') {
            // echo $form->field($model, 'password')->textInput(['maxlength' => true]);
        }

        if (Yii::$app->user->can('admin')) {
            $var = [User::STATUS_ACTIVE => 'Activo', User::STATUS_DELETED => 'Inactivo'];
            echo $form->field($model, 'status')->dropDownList($var, ['prompt' => 'Seleccione Uno' ]);
            
            $var = \yii\helpers\ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name');
            echo $form->field($model, 'role')->dropDownList($var, ['prompt' => 'Seleccione Uno' ]);
        }
    ?>

    <div class="form-group pt-4">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success w-100']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
