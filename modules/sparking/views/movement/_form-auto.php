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
        'fieldConfig' => [
            'template' => "<div class=\"form-floating pb-3\">{input}\n{label}\n{error}</div>",
            // 'labelOptions' => ['class' => ''],
            // 'inputOptions' => ['class' => 'form-control'],
            // 'errorOptions' => ['class' => 'col-lg-12 invalid-feedback'],
        ],
    ]); ?>
        <?php if (empty($model->id)) : ?>
            <?= $form->field($model, 'plate')->textInput(['placeholder' => "***", 'autofocus' => true, 'class' => 'form-control']) ?>
            <?= $form->field($model, 'type_id')->radioList(
                \yii\helpers\ArrayHelper::map(TypeParking::find()->andWhere('id > 1')->all(), 'id', 'name'), []
            )->label(false); ?>
            <!-- <div class="form-floating mb-3">
                <ol class="list-group list-group pt-3">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto"><div class="fw-bold">Fecha de llegada</div></div>
                        <span><?= $model->check_in ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto"><div class="fw-bold">Usuario de registro</div></div>
                        <span><?= $model->checkInUser->username ?></span>
                    </li>
                </ol>
            </div> -->
        <?php else: ?>
            <div class="form-floating mb-3">
                <ol class="list-group list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                        <div class="fw-bold">Placa del vehiculo</div>
                        <?= $model->type->name ?>
                        </div>
                        <span class="my-auto"><?= $model->plate ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                        <div class="fw-bold">Registro de Entrada</div>
                        <?= $model->checkInUser->username ?>
                        </div>
                        <span class="my-auto"><?= $model->check_in ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                        <div class="fw-bold">Registro de Salida</div>
                        <?= $model->checkOutUser->username ?>
                        </div>
                        <span class="my-auto"><?= $model->check_out ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Tiempo transcurrido</div>
                        </div>
                        <?= 
                            ($diferencia->y>0 ? "<span class=\"badge bg-primary rounded-pill me-1\">{$diferencia->y} año(s)</span>" : '') 
                            . ($diferencia->m>0 ? "<span class=\"badge bg-primary rounded-pill me-1\">{$diferencia->m} mes(es)</span>" : '') 
                            . ($diferencia->d>0 ? "<span class=\"badge bg-primary rounded-pill me-1\">{$diferencia->d} dia(s)</span>" : '') 
                            . ($diferencia->h>0 ? "<span class=\"badge bg-primary rounded-pill me-1\">{$diferencia->h} hora(s)</span>" : '') 
                            . ($diferencia->i>0 ? "<span class=\"badge bg-primary rounded-pill me-1\">{$diferencia->i} minuto(s)</span>" : '') 
                            . ($diferencia->s>0 ? "<span class=\"badge bg-primary rounded-pill me-1\">{$diferencia->s} segundo(s)</span>" : '') 
                            . ($diferencia->f>0 ? "<span class=\"badge bg-primary rounded-pill me-1\">{$diferencia->f} milisegundo(s)</span>" : '') 
                        ?>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold text-danger">Tiempo cobro</div>
                            X Fracciones.
                        </div>
                        <div class="my-auto">
                            <?= 
                                ($payment_time->y>0 ? "<span class=\"badge bg-danger rounded-pill me-1\">{$payment_time->y} año(s)</span>" : '') 
                                . ($payment_time->m>0 ? "<span class=\"badge bg-danger rounded-pill me-1\">{$payment_time->m} mes(es)</span>" : '') 
                                . ($payment_time->d>0 ? "<span class=\"badge bg-danger rounded-pill me-1\">{$payment_time->d} dia(s)</span>" : '') 
                                . ($payment_time->h>0 ? "<span class=\"badge bg-danger rounded-pill me-1\">{$payment_time->h} hora(s)</span>" : '') 
                                . ($payment_time->i>0 ? "<span class=\"badge bg-danger rounded-pill me-1\">{$payment_time->i} minuto(s)</span>" : '') 
                                . ($payment_time->s>0 ? "<span class=\"badge bg-danger rounded-pill me-1\">{$payment_time->s} segundo(s)</span>" : '') 
                                . ($payment_time->f>0 ? "<span class=\"badge bg-danger rounded-pill me-1\">{$payment_time->f} milisegundo(s)</span>" : '') 
                            ?>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                        <div class="fw-bold">Valor (COP)</div>
                        </div>
                        <span class="badge bg-primary rounded-pill"><?= $model->payment_value ?></span>
                    </li>
                </ol>

                <ul class="list-group mb-3">
                    <?php if ($model->type->prices['f']['price'] > 0) : ?>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Fracción</h6>
                                <small><?= "{$model->type->prices['f']['price']} por cada {$model->type->prices['f']['f']}; despues de {$model->type->prices['f']['max']} se cobra el siguiente." ?></small>
                            </div>
                            <span class="text-body-secondary"><?= $payment_time->f * $model->type->prices['f']['price'] ?></span>
                        </li>
                    <?php endif; ?>
                    <?php if ($model->type->prices['s']['price'] > 0) : ?>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Segundos</h6>
                                <small><?= "{$model->type->prices['s']['price']} por cada {$model->type->prices['s']['f']}; despues de {$model->type->prices['s']['max']} se cobra el siguiente." ?></small>
                            </div>
                            <span class="text-body-secondary"><?= $payment_time->s * $model->type->prices['s']['price'] ?></span>
                        </li>
                    <?php endif; ?>
                    <?php if ($model->type->prices['i']['price'] > 0) : ?>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Minutos</h6>
                                <small><?= "{$model->type->prices['i']['price']} por cada {$model->type->prices['i']['f']}; despues de {$model->type->prices['i']['max']} se cobra el siguiente." ?></small>
                            </div>
                            <span class="text-body-secondary"><?= $payment_time->i * $model->type->prices['i']['price'] ?></span>
                        </li>
                    <?php endif; ?>
                    <?php if ($model->type->prices['h']['price'] > 0) : ?>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Horas</h6>
                                <small><?= "{$model->type->prices['h']['price']} por cada {$model->type->prices['h']['f']}; despues de {$model->type->prices['h']['max']} se cobra el siguiente." ?></small>
                            </div>
                            <span class="text-body-secondary"><?= $payment_time->h * $model->type->prices['h']['price'] ?></span>
                        </li>
                    <?php endif; ?>
                    <?php if ($model->type->prices['d']['price'] > 0) : ?>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Dias</h6>
                                <small><?= "{$model->type->prices['d']['price']} por cada {$model->type->prices['d']['f']}; despues de {$model->type->prices['d']['max']} se cobra el siguiente." ?></small>
                            </div>
                            <span class="text-body-secondary"><?= $payment_time->d * $model->type->prices['d']['price'] ?></span>
                        </li>
                    <?php endif; ?>
                    <?php if ($model->type->prices['m']['price'] > 0) : ?>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Meses</h6>
                                <small><?= "{$model->type->prices['m']['price']} por cada {$model->type->prices['m']['f']}; despues de {$model->type->prices['m']['max']} se cobra el siguiente." ?></small>
                            </div>
                            <span class="text-body-secondary"><?= $payment_time->m * $model->type->prices['m']['price'] ?></span>
                        </li>
                    <?php endif; ?>
                    <?php if ($model->type->prices['y']['price'] > 0) : ?>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Años</h6>
                                <small><?= "{$model->type->prices['y']['price']} por cada {$model->type->prices['y']['f']}." ?></small>
                            </div>
                            <span class="text-body-secondary"><?= $payment_time->y * $model->type->prices['y']['price'] ?></span>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="form-group py-2">
            <?= Html::submitButton('Registrar ' . (empty($model->id) ? 'entrada' : 'salida'), ['class' => 'w-100 btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>