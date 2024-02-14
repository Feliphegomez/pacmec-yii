<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Inicio de sesion';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <!-- <form>
        <img class="mb-4 mx-auto d-block" src="<?= Yii::getAlias('@web/images/logos/Logo-header.png') ?>" alt="" height="57">
        <h1 class="h3 mb-3 fw-normal text-center"><?= Html::encode($this->title) ?></h1>

        <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
        </div>

        <div class="form-check text-start my-3">
        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            Remember me
        </label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
    </form> -->
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'fieldConfig' => [
            'template' => "<div class=\"form-floating\">{input}\n{label}\n{error}</div>",
            'labelOptions' => ['class' => ''],
            'inputOptions' => ['class' => 'form-control'],
            'errorOptions' => ['class' => 'col-lg-12 invalid-feedback'],
        ],
    ]); ?>
        <img class="mb-4 mx-auto d-block" src="<?= Yii::getAlias('@web/images/logos/Logo-header.png') ?>" alt="" height="57">
        <h1 class="h3 mb-3 fw-normal text-center"><?= Html::encode($this->title) ?></h1>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => ' ']) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => ' ']) ?>
        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>
        <div class="form-group">
            <div>
                <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary w-100 py-2', 'name' => 'login-button']) ?>
            </div>
        </div>
        <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
    <?php ActiveForm::end(); ?>
</div>
