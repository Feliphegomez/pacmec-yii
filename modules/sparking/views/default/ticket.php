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
?>
<table class="table">
    <!-- <tr class="text-center"><td colspan="2"><h3>&#9651;</h3></td></tr> -->
    <tr class="text-center">
        <td colspan="2">
            <h1 style="margin: 0 .3em;">BIENVENIDOS</h1>
            <h5 style="margin: 0;"><?= Yii::$app->params['siteFullName'] ?></h5>
            <h3 style="margin: 0.5em 1em;"><?= Yii::$app->params['parkingName'] ?></h3>
            <h6 style="margin: 0.5em 1em;">
                <?= Yii::$app->params['parkingAddress'] ?> Tel: <?= Yii::$app->params['parkingPhone'] ?> Cel: <?= Yii::$app->params['parkingMobile'] ?>
                <br><?= Yii::$app->params['parkingNIT'] ?> 
            </h6>
            <h5 style="margin: .8em;"><?= Yii::$app->params['parkingSchedule'] ?></h5>
        </td>
    </tr>
    <tr class="text-center">
        <td colspan="2"><h2 style="margin: .5em 0em;"><?= $model->plate ?></h2></td>
    </tr>
    <tr class="text-center">
        <td colspan="2">
            <?php Barcode::widget([
                // 'value'         => $model->plate . "-" . str_pad($model->id, 11, "0", STR_PAD_LEFT) . "" . str_replace(["-", ":", " "], "", "{$model->check_in}") . "-" . str_pad($model->id, 11, "0", STR_PAD_LEFT),
                'value'         => "$model->plate",
                // 'format'        => Barcode::CODE128C,
                'pluginOptions' => [
                    'displayValue' => false,
                    'width' => 2,
                    'height' => 40,
                    'margin' => 2,
                    // 'ean128' => true,
                ]
            ]);
            ?>
        </td>
    </tr>
    <tr>
        <td class="text-start"></td>
        <td class="text-end"><b>Fecha de Ingreso:</b> <?= $model->check_in ?></td>
    </tr>
    <tr>
        <td colspan="2" style="padding: 1em .5em;"><?= Yii::$app->params['parkingRegulations'] ?></td>
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