<?php 

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Roles y permisos';
$this->params['breadcrumbs'][] = $this->title;

$available_roles = Yii::$app->authManager->getRoles();
$permissions = Yii::$app->authManager->getPermissions();
$checker = [];
$checker_r = [];
?>
<div class="profile-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <?php foreach ($available_roles as $role_key => $role) : 
                        $checker[$role_key] = Yii::$app->authManager->getPermissionsByRole($role_key);
                        ?>
                        <th scope="col"><?= $role_key ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($permissions as $permission_key => $permission) : ?>
                    <tr>
                        <th scope="row"><?= $permission_key ?></th>
                        <?php foreach ($available_roles as $role_key => $role) : ?>
                            <td><?= (isset($checker[$role_key][$permission_key])) ? "<i class=\"bi bi-check-lg\"></i>" : "<i class=\"bi bi-x-lg\"></i>"; ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="container">
        <h1>Roles Heredados</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <?php foreach ($available_roles as $role_key => $role) : 
                        $checker_r[$role_key] = Yii::$app->authManager->getChildRoles($role_key);
                        ?>
                        <th scope="col"><?= $role_key ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($available_roles as $role_key => $role) : ?>
                    <tr>
                        <th scope="row"><?= $role_key ?></th>
                        <?php foreach ($available_roles as $role_key2 => $role2) : ?>
                            <td><?= (isset($checker_r[$role_key][$role_key2])) ? "<i class=\"bi bi-check-lg\"></i>" : "<i class=\"bi bi-x-lg\"></i>"; ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>