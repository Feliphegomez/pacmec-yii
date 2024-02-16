<?php

use app\models\Membership;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Plans $model */
/** @var yii\widgets\ActiveForm $form */
\conquer\momentjs\MomentjsAsset::register($this);
?>
<div class="plans-form">
    <?php if (Yii::$app->session->hasFlash('existPlan')): ?>
        <div class="alert alert-warning">
            El vehiculo ya cuenta con una membresia.

            <?php 
                if (isset($dataProvider)) {
                    foreach ($dataProvider->models as $modls) {
                        echo json_encode($modls);
                    }
                }
            ?>
        </div>
    <?php endif ?>
    <?php if (Yii::$app->session->hasFlash('successPlan')): ?>
        <div class="alert alert-success">El plan se agrego con exito.</div>
        <!-- <p>
            <div class="d-grid gap-2 col-10 mx-auto">
                <a class="btn btn-outline-primary" href="#" onclick="javascript:openTicketPlanById()">Imprimir comprobante</a>
            </div>
        </p> -->
    <?php endif ?>

    <?php $form = ActiveForm::begin([
        // 'action' => ['movements/create'],
        'method' => 'post',
        'options' => [
            'class' => 'p-4 p-md-4 border rounded-3 bg-body-tertiary',
        ],
    ]); ?>
        <?php if (empty($model->type_id)) : ?>
            <?= $form->field($model, 'plate')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'type_id')->radioList(
                \yii\helpers\ArrayHelper::map(\app\models\TypeParking::find()->all(), 'id', 'name'),
            ); ?>
        <?php else : ?>
            <?= $form->field($model, 'plate')->hiddenInput(['maxlength' => true])->label(false) ?>
            <?= $form->field($model, 'type_id')->hiddenInput()->label(false) ?>
            <?php 
                $membershipList = Membership::find()->where([
                    'type_id' => $model->type_id,
                ])->all();

                $membershipNamesList = \yii\helpers\ArrayHelper::map($membershipList, 'id', function ($model) {
                    return "{$model->name}";
                });
                $membershipPricesList = \yii\helpers\ArrayHelper::map($membershipList, 'id', function ($model) {
                    return "{$model->price}";
                });
                $membershipDurationList = \yii\helpers\ArrayHelper::map($membershipList, 'id', function ($model) {
                    return ($model->duration);
                });
            ?>
            <?= $form->field($model, 'membership_id')->dropDownList(\yii\helpers\ArrayHelper::map($membershipList, 'id', function ($model) {
                return "{$model->name} ({$model->price}) ";
            }), 
            [
                'prompt'=>'-Seleccione la membresia/plan',
                'onchange'=>  '
                    let indexSelec = $("#plans-membership_id").val(); 
                    let namesList = '.json_encode($membershipNamesList).'; 
                    let pricesList = '.json_encode($membershipPricesList).'; 
                    let durationList = '.json_encode($membershipDurationList).'; 
                    let durationSelec = durationList[indexSelec]; 
                    let date_start = new moment();
                    let date_end = new moment(date_start);
                    let textDuration = "";

                    console.log("name", namesList[indexSelec])
                    console.log("price", pricesList[indexSelec])
                    console.log("duration", durationSelec)
                    console.log("durationList.m", durationSelec.m)

                    if (durationSelec.f > 0) textDuration += durationSelec.f + "ms, ", date_end.add(durationSelec.f, "ms");
                    if (durationSelec.s > 0) textDuration += durationSelec.s + "s, ", date_end.add(durationSelec.s, "s");
                    if (durationSelec.i > 0) textDuration += durationSelec.i + "min, ", date_end.add(durationSelec.i, "m");
                    if (durationSelec.h > 0) textDuration += durationSelec.h + "hora(s), ", date_end.add(durationSelec.h, "h");
                    if (durationSelec.d > 0) textDuration += durationSelec.d + "dia(s), ", date_end.add(durationSelec.d, "d");
                    if (durationSelec.m > 0) textDuration += durationSelec.m + "mes(es), ", date_end.add(durationSelec.m, "M");
                    if (durationSelec.y > 0) textDuration += durationSelec.a + "año(s), ", date_end.add(durationSelec.y, "y");

                    console.log(date_start.toISOString().slice(0, 19).replace("T", " "))
                    console.log(date_end.toISOString().slice(0, 19).replace("T", " "))
                    
                    $("#plans-date_start").val(date_start.toISOString().slice(0, 19).replace("T", " "));
                    $("#plans-date_end").val(date_end.toISOString().slice(0, 19).replace("T", " "));
                    $("#plan-name").text(namesList[indexSelec] ?? "Seleccione el plan");
                    $("#plan-duration").text(textDuration ?? "Seleccione el plan");
                    $("#plan-precio").text(pricesList[indexSelec] ?? "Seleccione el plan");
                    $("#plan-inicio").text(date_start.toISOString().slice(0, 19).replace("T", " "));
                    $("#plan-fin").text(date_end.toISOString().slice(0, 19).replace("T", " "));
                '
            ]
            );
            ?>
            <?= $form->field($model, 'date_start')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'date_end')->hiddenInput()->label(false) ?>
        <?php endif; ?>
        <div class="form-group">
            <?= Html::submitButton('Confirmar', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

    <?php if (!empty($model->type_id)) : ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 my-3">
                    
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Placa del vehiculo</h6>
                                <!-- <small>se cobra el siguiente</small> -->
                            </div>
                            <span class="text-body-secondary"><?= $model->plate ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Tipo de vehiculo</h6>
                                <!-- <small>se cobra el siguiente</small> -->
                            </div>
                            <span class="text-body-secondary"><?= $model->type->name ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Tipo de plan</h6>
                                <!-- <small>se cobra el siguiente</small> -->
                            </div>
                            <span class="text-body-secondary" id="plan-name">XXXXXXXXXXX</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Precio del plan</h6>
                                <!-- <small>se cobra el siguiente</small> -->
                            </div>
                            <span class="text-body-secondary" id="plan-precio">XXXXXXXXXXX</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Duracion del plan</h6>
                                <!-- <small>se cobra el siguiente</small> -->
                            </div>
                            <span class="text-body-secondary" id="plan-duration">XXXXXXXXXXX</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Inicio del plan</h6>
                                <!-- <small>se cobra el siguiente</small> -->
                            </div>
                            <span class="text-body-secondary" id="plan-inicio">XXXXXXXXXXX</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Culminacion del plan</h6>
                                <!-- <small>se cobra el siguiente</small> -->
                            </div>
                            <span class="text-body-secondary" id="plan-fin">XXXXXXXXXXX</span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
