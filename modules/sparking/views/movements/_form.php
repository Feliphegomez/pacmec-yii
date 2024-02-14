<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\sparking\models\TypeParking;

/** @var yii\web\View $this */
/** @var app\models\Movements $model */
/** @var yii\widgets\ActiveForm $form */

$diferencia = $model->time_elapsed ?? (object) [];
?>
<div class="movements-form">
    <?php if (Yii::$app->session->hasFlash('existVehicle')): ?>
        <div class="alert alert-warning">
            El vehiculo ya se encuentra registrado.
        </div>
    <?php endif ?>
    <?php if (Yii::$app->session->hasFlash('existPlanE')): ?>
        <div class="alert alert-warning">
            El vehiculo cuenta con un plan.
        </div>
    <?php endif ?>

    <?php $form = ActiveForm::begin([
        // 'action' => ['movements/create'],
        'method' => 'post',
        'options' => [
            'class' => '',
        ],
    ]); ?>

    <?php if (empty($model->id)) : ?>
        <?= $form->field($model, 'type_id')->radioList(
            \yii\helpers\ArrayHelper::map(TypeParking::find()->andWhere('id > 1')->all(), 'id', 'name'),
        ); ?>
        <?= $form->field($model, 'plate')->textInput(['placeholder' => "***", 'autofocus' => true ]) ?>

        <div class="form-floating mb-3">
            <ul class="list-group">
                <li href="#" class="list-group-item ">
                    <h4 class="list-group-item-heading">Fecha de llegada</h4>
                    <span class="badge"><?= $model->check_in ?></span>
                    <p class="list-group-item-text">.</p>
                </li>
                <li href="#" class="list-group-item ">
                    <h4 class="list-group-item-heading">Usuario de llegada</h4>
                    <span class="badge"><?= $model->checkInUser->username ?></span>
                    <p class="list-group-item-text">.</p>
                </li>
            </ul>
        </div>
    <?php else: ?>
        <div class="form-floating mb-3">
            <ul class="list-group">
                <li href="#" class="list-group-item">
                    <h4 class="list-group-item-heading">Placa del vehículo</h4>
                    <span class="badge"><?= $model->plate ?></span>
                    <p class="list-group-item-text"><?= $model->type->name ?></p>
                </li>
                <li href="#" class="list-group-item ">
                    <h4 class="list-group-item-heading">Ingreso</h4>
                    <span class="badge badge-transparent"><?= $model->check_in ?></span>
                    <p class="list-group-item-text"><?= $model->checkInUser->username ?></p>
                </li>
                <li href="#" class="list-group-item ">
                    <h4 class="list-group-item-heading">Salida</h4>
                    <span class="badge badge-transparent"><?= $model->check_out ?></span>
                    <p class="list-group-item-text"><?= $model->checkOutUser->username ?></p>
                </li>
            </ul>
            <ul class="list-group">
                <!-- <li href="#" class="list-group-item ">
                    <span class="badge badge-success">
                        <?= 
                            ($diferencia->y>0 ? "{$diferencia->y} a. " : '') 
                            . ($diferencia->m>0 ? "{$diferencia->m} M. " : '') 
                            . ($diferencia->d>0 ? "{$diferencia->d} d. " : '') 
                            . ($diferencia->h>0 ? "{$diferencia->h} h. " : '') 
                            . ($diferencia->i>0 ? "{$diferencia->i} m. " : '') 
                            . ($diferencia->s>0 ? "{$diferencia->s} s. " : '') 
                            . ($diferencia->f>0 ? "{$diferencia->f} f. " : '') 
                        ?>
                    </span>
                    <h5 class="list-group-item-heading text-success">Tiempo transcurrido</h5>
                </li> -->
                <li href="#" class="list-group-item ">
                    <span class="badge badge-error">
                        <?= 
                            ($payment_time->y>0 ? "{$payment_time->y} f.a. " : '') 
                            . ($payment_time->m>0 ? "{$payment_time->m} f.M. " : '') 
                            . ($payment_time->d>0 ? "{$payment_time->d} f.d. " : '') 
                            . ($payment_time->h>0 ? "{$payment_time->h} f.h. " : '') 
                            . ($payment_time->i>0 ? "{$payment_time->i} f.m. " : '') 
                            . ($payment_time->s>0 ? "{$payment_time->s} f.s. " : '') 
                            . ($payment_time->f>0 ? "{$payment_time->f} f.f. " : '') 
                        ?>
                    </span>
                    <h5 class="list-group-item-heading text-danger">Tiempo cobro</h5>
                </li>
                <li href="#" class="list-group-item ">
                    <span class="badge badge-inverse"><?= $model->payment_value ?></span>
                    <h4 class="list-group-item-heading">Valor (COP)</h4>
                </li>
            </ul>

            <!-- <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Fracción</h6>
                        <small><?= "{$model->type->prices['f']['price']} por cada {$model->type->prices['f']['f']}; despues de {$model->type->prices['f']['max']} se cobra el siguiente." ?></small>
                    </div>
                    <span class="text-body-secondary"><?= $payment_time->f * $model->type->prices['f']['price'] ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Segundos</h6>
                        <small><?= "{$model->type->prices['s']['price']} por cada {$model->type->prices['s']['f']}; despues de {$model->type->prices['s']['max']} se cobra el siguiente." ?></small>
                    </div>
                    <span class="text-body-secondary"><?= $payment_time->s * $model->type->prices['s']['price'] ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Minutos</h6>
                        <small><?= "{$model->type->prices['i']['price']} por cada {$model->type->prices['i']['f']}; despues de {$model->type->prices['i']['max']} se cobra el siguiente." ?></small>
                    </div>
                    <span class="text-body-secondary"><?= $payment_time->i * $model->type->prices['i']['price'] ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Horas</h6>
                        <small><?= "{$model->type->prices['h']['price']} por cada {$model->type->prices['h']['f']}; despues de {$model->type->prices['h']['max']} se cobra el siguiente." ?></small>
                    </div>
                    <span class="text-body-secondary"><?= $payment_time->h * $model->type->prices['h']['price'] ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Dias</h6>
                        <small><?= "{$model->type->prices['d']['price']} por cada {$model->type->prices['d']['f']}; despues de {$model->type->prices['d']['max']} se cobra el siguiente." ?></small>
                    </div>
                    <span class="text-body-secondary"><?= $payment_time->d * $model->type->prices['d']['price'] ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Meses</h6>
                        <small><?= "{$model->type->prices['m']['price']} por cada {$model->type->prices['m']['f']}; despues de {$model->type->prices['m']['max']} se cobra el siguiente." ?></small>
                    </div>
                    <span class="text-body-secondary"><?= $payment_time->m * $model->type->prices['m']['price'] ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Años</h6>
                        <small><?= "{$model->type->prices['y']['price']} por cada {$model->type->prices['y']['f']}." ?></small>
                    </div>
                    <span class="text-body-secondary"><?= $payment_time->y * $model->type->prices['y']['price'] ?></span>
                </li>
            </ul> -->
        </div>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Registrar ' . (empty($model->id) ? 'entrada' : 'salida'), ['class' => 'w-100 btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<style>
.badge-transparent {
  background-color: transparent !important;
  color: #333333;
}

.badge-error {
  background-color: #b94a48;
}
.badge-warning {
  background-color: #f89406;
}
.badge-success {
  background-color: #5cc45e;
}
.badge-info {
  background-color: #3a87ad;
}
.badge-inverse {
  background-color: #333333;
}
</style>