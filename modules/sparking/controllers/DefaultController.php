<?php 

namespace app\modules\sparking\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\sparking\models\Movement;
use app\modules\sparking\models\MovementsSearch;
use app\modules\sparking\models\Membership;
use app\modules\sparking\models\Menus;
use app\modules\sparking\models\MovementSearch;
use app\modules\sparking\models\Plan;
use app\modules\sparking\models\PlanSearch;
use yii\data\ActiveDataProvider;

class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'activity', 'ingreso-vehiculo', 'salida-vehiculo', 'producto-caja', 'base-caja', 'ingreso-plan', 'reporte-dia', 'reporte-semana', 'reporte-mes', 'reporte-usuario'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'activity', 'reporte-usuario', 'base-caja', 'producto-caja', 'ingreso-vehiculo', 'salida-vehiculo', 'ingreso-plan'],
                        'roles' => ['cashier'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['reporte-dia', 'reporte-semana', 'reporte-mes'],
                        'roles' => ['admin'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    // $this->redirect(['/site/error'], 403);
                    throw new NotFoundHttpException('No tienes los suficientes permisos para acceder a esta página.', 403);
                    // exit("No tienes los suficientes permisos para acceder a esta página.");
                }
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
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
        Menus::addMenuParking();
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('admin')) {
            return $this->render('index-admin', [
            ]);
        } else {
            return $this->render('index', [
            ]);
        }
    }

    public function actionIngresoVehiculo($addId=null)
    {
        $model = new Movement();
        $model->check_in = date('Y-m-d H:i:s');
        $model->check_in_user_id = Yii::$app->user->identity->id;
        Yii::$app->session->removeFlash('existPlanE');
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $query = Movement::find();
                $query->andFilterWhere([
                    'plate' => $model->plate,
                    'type_id' => $model->type_id,
                ]);
                $query->andWhere('check_out IS NULL');
                // $query->andFilterWhere(['not', ['check_out_user_id' => null]]);
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
                if (count($dataProvider->models) > 0) {
                    Yii::$app->session->setFlash('existVehicle');
                    // $model = new Movement();

                    // echo json_encode($dataProvider->models[0]->id);
                } else {
                    if ($model->check_out == null  && $model->save()) {
                        // Yii::$app->session->setFlash('VehicleEntrySuccessful!');
                        // return $this->refresh();
                        return $this->redirect(['ingreso-vehiculo', 'addId' => $model->id]);
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        // $searchModel = new MovementsSearch();
        // $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('ingreso-vehiculo', [
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
            'model' => $model,
            'addId' => $addId,
        ]);
    }

    public function actionSalidaVehiculo($id=null, $outId=null)
    {
        $searchModel = new MovementSearch([
            'is_open' => 1,
        ]);
        $dataProvider = $searchModel->searchNull($this->request->queryParams);
        // $dataProvider = $searchModel->search([
        //     // 'MovementsSearch' => ['check_out_user_id' => 0]
        //     'MovementsSearch' => [
        //         // 'plate' => $this->request->queryParams['MovementsSearch']['plate'] ?? null,
        //     ]
        // ]);

        $model = null;
        $payment_time = json_decode('{"d": 0,"f": 0,"h": 0,"i": 0,"m": 0,"s": 0,"y": 0}');

        if ($id) {
            if (($model = Movement::findOne(['id' => $id])) !== null) {
                $model->check_out = date('Y-m-d H:i:s');
                $model->check_out_user_id = Yii::$app->user->identity->id;
        
                // Crear objetos DateTime con los timestamps
                $fechaIngreso = new \DateTime("$model->check_in", new \DateTimeZone("America/Bogota"));
                $fechaSalida = new \DateTime("$model->check_out", new \DateTimeZone("America/Bogota"));
        
                // Calcular la diferencia entre las fechas
                $diferencia = $fechaIngreso->diff($fechaSalida);
                $model->time_elapsed = $diferencia;
                $model->payment_value = 0;

                if (!empty($model->id)) {
                    $cobro = [];
                    $item = (object) [];

                    $l_r = [0 => 'f', 1 => 's', 2 => 'i', 3 => 'h', 4 => 'd', 5 => 'm', 6 => 'y'];
                    foreach ($l_r as $i => $letter) {
                        $item = (object) [
                            'label' => $letter,
                            'f' => $model->type->prices[$letter]['f'],
                            'max' => $model->type->prices[$letter]['max'],
                            'price' => $model->type->prices[$letter]['price'],
                            'diferencia' => $diferencia->{$letter},
                            'pay_time' => 0,
                            'payment' => 0.0,
                        ];
                        
                        if ($item->price > 0 && $item->diferencia > 0) {
                            if ($item->diferencia >= $item->max) {
                                $diferencia->{$l_r[$i+1]}++;
                                // $item->pay_time++;
                            }
                            else {
                                if ($item->diferencia < $item->f) {
                                    $item->pay_time++;
                                }
                                else {
                                    $a = $item->diferencia / $item->f;
                                    $a_a = (int) $a;
                                    $a_b = (float) $a;
                                    $b = ($a_b > $a_a) ? $a_a++ : $a_a;
                                    $item->pay_time += $b;
                                }
                            }
                            
                            $item->payment = $item->price * $item->pay_time;
                            $payment_time->{$letter} = $item->pay_time;
                            $model->payment_value += $item->payment;

                            $cobro[$letter] = $item;
                        }
                    }


                    $model->payment_value = $payment_time->f * $model->type->prices['f']['price']
                    + $payment_time->s * $model->type->prices['s']['price']
                    + $payment_time->i * $model->type->prices['i']['price']
                    + $payment_time->h * $model->type->prices['h']['price']
                    + $payment_time->d * $model->type->prices['d']['price']
                    + $payment_time->m * $model->type->prices['m']['price']
                    + $payment_time->y * $model->type->prices['y']['price'];

                    // Is Plan
                    $query = Plan::find();
                    $query->andFilterWhere([
                        'plate' => $model->plate,
                        'type_id' => $model->type_id,
                    ]);
                    $query->andWhere('date_end >= NOW()');
    
                    $dataProvider = new ActiveDataProvider([
                        'query' => $query,
                    ]);
                    if (count($dataProvider->models) > 0) {
                        Yii::$app->session->setFlash('existPlanE');
                        $model->payment_value = 0;
                    }
                }

                // \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                // return (object) [
                //     'd_in' => (object) $model->check_in,
                //     'd_out' => (object) $model->check_out,
                //     'cobro' => (object) $cobro,
                //     'payment_time' => $payment_time,
                //     'payment_value' => $model->payment_value,
                //     'diferencia' => $diferencia,
                //     'limits' => $model->type->prices,
                // ];

                if ($this->request->isPost) {
                    if ($model->save()) {
                        // return $this->redirect(['view', 'id' => $model->id]);
                        return $this->redirect(['salida-vehiculo', 'outId' => $model->id]);
                    }
                }
            }
            else throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('salida-vehiculo', [
            'outId' => $outId,
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'payment_time' => $payment_time,
        ]);
    }

    public function actionReporte() 
    {
        $searchModel = new MovementSearch();
        
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('reporte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchFormEnable' => true,
        ]);
    }

    public function actionReporteUsuario() 
    {
        $searchModel = new MovementSearch([
            'check_out_user_id' => Yii::$app->user->identity->id,
            'check_out_desde' => date('Y-m-d 00:00:00'),
            'check_out_hasta' => date('Y-m-d 23:59:59'),
        ]);

        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('reporte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReporteDia() 
    {
        $searchModel = new MovementSearch([
            // 'check_out_user_id' => Yii::$app->user->identity->id,
            'check_out_desde' => date('Y-m-d 00:00:00'),
            'check_out_hasta' => date('Y-m-d 23:59:59'),
        ]);

        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('reporte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);        
    }

    public function actionReporteSemana() 
    {
        $diaSemana = date("w");
        # Calcular el tiempo (no la fecha) de cuándo fue el inicio de semana
        $tiempoDeInicioDeSemana = strtotime("-" . ($diaSemana-1) . " days"); # Restamos -X days
        # Y formateamos ese tiempo
        $fechaInicioSemana = date("Y-m-d 00:00:00", $tiempoDeInicioDeSemana);
        # Ahora para el fin, sumamos
        $tiempoDeFinDeSemana = strtotime("+" . $diaSemana . " days", $tiempoDeInicioDeSemana); # Sumamos +X days, pero partiendo del tiempo de inicio
        # Y formateamos
        $fechaFinSemana = date("Y-m-d 23:59:59", $tiempoDeFinDeSemana);
        
        $searchModel = new MovementSearch([
            // 'check_out_user_id' => Yii::$app->user->identity->id,
            'check_out_desde' => $fechaInicioSemana,
            'check_out_hasta' => $fechaFinSemana,
        ]);

        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('reporte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);



        $searchModel = new MovementSearch();
        
        $searchModel = new MovementsSearch();
        $dataProvider = $searchModel->searchPays([
            'MovementsSearch' => [
            ]
        ]);
		$dataProvider->pagination->pageSize = 10000;
		$dataProvider->sort->defaultOrder = ['id' => SORT_DESC];
        return $this->render('reporte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReporteMes() 
    {
        $searchModel = new MovementSearch([
            // 'check_out_user_id' => Yii::$app->user->identity->id,
            'check_out_desde' => date("Y-m-01 00:00:00"),
            'check_out_hasta' => date("Y-m-t 23:59:59"),
        ]);

        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('reporte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        $searchModel = new MovementSearch();
        $diaSemana = date("w");
        # Calcular el tiempo (no la fecha) de cuándo fue el inicio de semana
        $tiempoDeInicioDeSemana = strtotime("-" . $diaSemana . " days"); # Restamos -X days
        # Y formateamos ese tiempo
        $fechaInicioSemana = date("Y-m-d", $tiempoDeInicioDeSemana);
        # Ahora para el fin, sumamos
        $tiempoDeFinDeSemana = strtotime("+" . $diaSemana . " days", $tiempoDeInicioDeSemana); # Sumamos +X days, pero partiendo del tiempo de inicio
        # Y formateamos
        $fechaFinSemana = date("Y-m-d", $tiempoDeFinDeSemana);
        
        $searchModel = new MovementsSearch();
        $dataProvider = $searchModel->searchPays([
            // 'pagination' => [
            //     'pageSize' => 50
            // ],
            'MovementsSearch' => [
                'check_out' => date("Y-m-01 00:00:00"),
                'check_out_hasta' => date("Y-m-t 23:59:59"),
            ]
        ]);
		$dataProvider->pagination->pageSize = 100000;
		$dataProvider->sort->defaultOrder = ['id' => SORT_DESC];
        return $this->render('reporte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTicketIn($id) 
    {
        $this->layout = '/empty';

        if (($model = Movement::findOne(['id' => $id])) !== null) {
            return $this->render('ticket', [
                'outId' => $id,
                'model' => $model,
            ]);
        }
        else throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTicketOut($id) 
    {
        $this->layout = '/empty';
        if (($model = Movement::findOne(['id' => $id])) !== null) {
            return $this->render('voucher', [
                'outId' => $id,
                'model' => $model,
            ]);
        }
        else throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Plans model.
     * 
     * @return string|\yii\web\Response
     */
    public function actionIngresoPlan($search_id=null, $addId=null) {
        $model = new Plan();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if (!empty($model->plate)) {
                    // $model->plate;
                    $query = Plan::find();
                    $query->andFilterWhere([
                        'plate' => $model->plate,
                        'type_id' => $model->type_id,
                    ]);
                    $query->andWhere('date_end >= NOW()');
                    // $query->andFilterWhere(['between', 'date_end', date('Y-m-01 00:00:00'), date('Y-m-d 23:59:59')]);

                    $dataProvider = new ActiveDataProvider([
                        'query' => $query,
                    ]);
                    if (count($dataProvider->models) > 0) {
                        Yii::$app->session->setFlash('existPlan');
                        $model = new Plan();
                    }
                    else {
                        if ($model->save()) {
                            Yii::$app->session->setFlash('successPlan');
                            // return $this->redirect(['view', 'id' => $model->id]);
                            
                            // Agregar movimiento
                            $model_movement = new Movement();
                            $model_movement->plate = "Membresia '{$model->membership->name}' para vehiculo '{$model->plate}'";
                            $model_movement->type_id = $model->type_id;
                            $model_movement->check_in = date('Y-m-d H:i:s');
                            $model_movement->check_in_user_id = Yii::$app->user->identity->id;
                            $model_movement->check_out = date('Y-m-d H:i:s');
                            $model_movement->check_out_user_id = Yii::$app->user->identity->id;
                            // $model_movement->time_elapsed = json_decode('{"d": 0, "f": 0, "h": 0, "i": 0, "m": 0, "s": 7, "y": 0}');
                            $model_movement->time_elapsed = null;
                            $model_movement->payment_value = $model->payment_value;
                            
                            if ($model_movement->save()) {
                                return $this->refresh();
                            } else {
                                
                            }
                        }
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('ingreso-plan', [
            'model' => $model,
            'addId' => $addId,
            'search_id' => $search_id,
            'dataProvider' => $dataProvider ?? null,
        ]);
    }

    public function actionBaseCaja($addId=null) 
    {
        $model = new Movement();
        $model->plate = "Inicio de caja de '".Yii::$app->user->identity->username."', fecha y hora " . date('Y-m-d H:i:s');
        $model->type_id = 1;
        $model->check_in = date('Y-m-d 00:00:00');
        $model->check_in_user_id = Yii::$app->user->identity->id;
        $model->check_out = date('Y-m-d 00:00:00');
        $model->check_out_user_id = Yii::$app->user->identity->id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->save()) {
                    // Yii::$app->session->setFlash('VehicleEntrySuccessful!');
                    // return $this->refresh();
                    return $this->redirect(['base-caja', 'addId' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('ingreso-base-caja', [
            'model' => $model,
            'addId' => $addId,
        ]);
    }

    public function actionProductoCaja($addId=null) 
    {
        $productos = [
            [
                "id" => "tapabocas",
                "name" => "Tapabocas",
                "text" => "Venta de \"Tapabocas\" desde caja",
                "price" => 1000,
            ]
        ];
        $model = new Movement();
        $model->type_id = 1;
        $model->check_in = date('Y-m-d h:i:00');
        $model->check_in_user_id = Yii::$app->user->identity->id;
        $model->check_out = date('Y-m-d h:i:00');
        $model->check_out_user_id = Yii::$app->user->identity->id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                foreach($productos as $prod) {
                    if ($prod['id'] == $model->plate) {
                        // $model->time_elapsed = json_decode('{"d": 0, "f": 0, "h": 0, "i": 0, "m": 0, "s": 7, "y": 0}');
                        $model->time_elapsed = null;
                        $model->payment_value = $prod['price'];
                        $model->plate = $prod['text'];
                    }
                }

                if ($model->save()) {
                    // Yii::$app->session->setFlash('VehicleEntrySuccessful!');
                    // return $this->refresh();
                    return $this->redirect(['producto-caja', 'addId' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('ingreso-producto-caja', [
            'model' => $model,
            'addId' => $addId,
            'productos' => $productos,
        ]);
    }

    // ------------------
    public function actionMemberships() {
        $dataProvider = new ActiveDataProvider([
            'query' => Membership::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('/membership/index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Movement models.
     *
     * @return string
     */
    public function actionActivity()
    {
        $searchModel = new MovementSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
		$dataProvider->pagination->pageSize = 5;
		$dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        return $this->render('activity', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTicketDetails($id) {
        if (($model = Movement::findOne(['id' => $id])) !== null) {
            return $this->render('ticket-details', [
                'model' => $model,
            ]);
        }

        throw new NotFoundHttpException('The requested page does not exist.');
        
    }

    public function actionMembers() {
        $searchModel = new PlanSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
		$dataProvider->pagination->pageSize = 5;
		$dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        return $this->render('members', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
