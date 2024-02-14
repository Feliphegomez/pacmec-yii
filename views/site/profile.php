<?php 
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\models\User;

/** @var yii\web\View $this */

$this->title = 'Mi perfil';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="h-100">
    <?= $this->render('/users/_profile', [
        'model' => $model,
    ]) ?>
  </div>
</section>