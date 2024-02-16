<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\sparking\models\Membership;
use app\modules\sparking\models\TypeParking;

/** @var yii\web\View $this */
/** @var app\models\Plans $model */
/** @var yii\widgets\ActiveForm $form */
// \conquer\momentjs\MomesntjsAsset::register($this);

?>
<script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>
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
        'fieldConfig' => [
            'template' => "<div class=\"form-floating pb-3\">{input}\n{label}\n{error}</div>",
            'labelOptions' => ['class' => ''],
            'inputOptions' => ['class' => 'form-control'],
            'errorOptions' => ['class' => 'col-lg-12 invalid-feedback'],
        ],
    ]); ?>
        <?php if (empty($model->type_id)) : ?>
            <?= $form->field($model, 'plate')->textInput(['placeholder' => "***", 'autofocus' => true, 'class' => 'form-control', 'maxlength' => true]) ?>
            <?= $form->field($model, 'type_id')->radioList(
                \yii\helpers\ArrayHelper::map(TypeParking::find()->andWhere('id > 1')->all(), 'id', 'name'),
            )->label(false); ?>
        <?php else : ?>
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
                'class' => 'form-control',
                'prompt'=>'-Seleccione la membresia/plan',
                'onchange'=>  '
                    let indexSelec = $("#plan-membership_id").val(); 
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
                    
                    $("#plan-date_start").val(date_start.toISOString().slice(0, 19).replace("T", " "));
                    $("#plan-date_end").val(date_end.toISOString().slice(0, 19).replace("T", " "));
                    $("#plan-payment_value").val((pricesList[indexSelec] ?? 0));
                    $("#plan-name").text(namesList[indexSelec] ?? "Seleccione el plan");
                    $("#plan-duration").text(textDuration ?? "Seleccione el plan");
                    $("#plan-precio").text(pricesList[indexSelec] ?? "Seleccione el plan");
                    $("#plan-inicio").text(date_start.toISOString().slice(0, 19).replace("T", " "));
                    $("#plan-fin").text(date_end.toISOString().slice(0, 19).replace("T", " "));
                '
            ]
            );
            ?>
            
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
                            <div class="fw-bold">Tipo de plan</div>
                            <font id="plan-name">plan-name</font>
                        </div>
                        <span class="badge bg-secondary my-auto me-2" id="plan-duration">plan-duration</span>
                        <span class="badge bg-success my-auto me-2" id="plan-precio">plan-precio</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Comienzo del plan</div>
                        </div>
                        <span class="my-auto me-2" id="plan-inicio">plan-inicio</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Culminacion del plan</div>
                        </div>
                        <span class="my-auto me-2" id="plan-fin">plan-fin</span>
                    </li>
                </ol>
            </div>

        <?php endif; ?>
        <div class="form-group">
            <?= Html::submitButton('Confirmar', ['class' => 'btn btn-primary w-100']) ?>
        </div>
        
        <?php if (!empty($model->type_id)) : ?>
            <?= $form->field($model, 'plate')->hiddenInput(['maxlength' => true])->label(false) ?>
            <?= $form->field($model, 'type_id')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'date_start')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'date_end')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'payment_value')->hiddenInput()->label(false) ?>
        <?php endif; ?>
    <?php ActiveForm::end(); ?>
</div>
