<?php
use diecoding\barcode\generator\Barcode;

/** @var yii\web\View $this */
/** @var app\models\Movements $model */
/** @var app\models\MovementsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ingreso de vehiculo';
// $this->params['breadcrumbs'][] = ['label' => 'Movements', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
$diferencia = $model->time_elapsed ?? (object) [];
$module = \Yii::$app->controller->module;
?>
<table class="table">
    <!-- <tr class="text-center"><td colspan="2"><h5>&#9651;</h5></td></tr> -->
    <tr class="text-center">
        <td colspan="2">
            <h1 style="margin: 0 .3em;">BIENVENIDOS</h1>
            <!-- <h5 style="margin: 0;"><?= $module->params['siteFullName'] ?></h5> -->
            <h3 style="margin: 0.5em 1em;"><?= $module->params['parkingName'] ?></h3>
            <h6 style="margin: 0.5em 1em;">
                <?= $module->params['parkingAddress'] ?> Tel: <?= $module->params['parkingPhone'] ?> Cel: <?= $module->params['parkingMobile'] ?>
                <br><?= $module->params['parkingNIT'] ?> 
            </h6>
            <h5 style="margin: .8em;"><?= $module->params['parkingSchedule'] ?></h5>
        </td>
    </tr>
    <tr class="text-center">
        <td colspan="2"><h2 style="margin: .5em 0em;"><?= strtoupper($model->plate) ?></h2></td>
    </tr>
    <tr>
        <td class="text-start"><b>Fecha de Ingreso:</b> </td>
        <td class="text-start"><?= $model->check_in ?></td>
    </tr>
    <tr>
        <td colspan="2" style="padding: 1em .5em;"><?= $module->params['parkingRegulations'] ?></td>
    </tr>
</table>



<style>
    *, html, body {
        /* zoom: .975; */
        font-family: Arial, Helvetica, sans-serif;
        /* font-size: xx-small; */
    }
    .text-center {
        text-align: center;
    }
</style>

<script>
addEventListener("afterprint", (event) => {
    console.log('Close');
    window.close();
});

window.addEventListener('load', () => {
    console.log('OK')
  window.print();
})
</script>