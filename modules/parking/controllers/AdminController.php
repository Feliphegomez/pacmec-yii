<?php 

namespace app\modules\parking\controllers;

use app\modules\parking\models\SettingsForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

class AdminController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['settings'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['settings'],
                        'roles' => ['admin'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    throw new NotFoundHttpException('No tienes los suficientes permisos para acceder a esta página.', 403);
                }
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function __construct($id, $module, $config)
    {
        parent::__construct($id, $module, $config ?? []);
        // Menus::addMenuParking();
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionSettings()
    {
        $model = new SettingsForm();
        return $this->render('settings', [
            'model' => $model,
        ]);
    }
}