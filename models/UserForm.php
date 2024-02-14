<?php

namespace app\models;

use Yii;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 */
class UserForm extends \yii\db\ActiveRecord
{
    public $password;
    public $role;
    public $_user;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    public function scenarios()
    {
        return [
            'create' => ['username', 'email', 'password', 'status', 'role'],
            'update' => ['username', 'email', 'status', 'role'],
            'myaccount' => ['username', 'email', 'password'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'status', 'role'], 'required', 'message' => 'El campo es obligatorio.'],
            
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Este nombre de usuario ya ha sido utilizado.', 'on' => 'create'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Esta dirección de correo electrónico ya ha sido tomada.', 'on' => 'create'],
            
            ['password', 'string', 'min' => 6],
            ['password', 'validatePassword', 'on' => 'myaccount'],
            [['status'], 'integer'],
            [['role'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Usuario',
            'email' => 'Correo electronico',
            'password' => 'Contraseña',
            'status' => 'Estado',
            'role' => 'Rol principal',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUserById($this->id);

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect password.');
            }
        }
    }
    
    /**
     * Finds user by [[id]]
     *
     * @return User|null
     */
    public function getUserById($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUserByUsername($username)
    {
        if (($model = User::findByUsername($username)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function createProfile() {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = $this->status;
            if (empty($this->password)) $user->setPassword($this->username);
            else $user->setPassword($this->password);
            $user->generateAuthKey();

            if ($user->save(false)) {
                $this->id = $user->id;
                // las siguientes tres líneas fueron agregadas
                $auth = Yii::$app->authManager;
                $authorRole = $auth->getRole($this->role);
                $auth->assign($authorRole, $user->getId());
            }

            return true;
        }
        return false;
    }

    public function setUser($_user) {
        $this->_user = $_user;
        // $this->role = \Yii::$app->authManager->getRolesByUser($_user->id);
    }

    public function getRole() {
        $roles = [];
        foreach (\Yii::$app->authManager->getRolesByUser($this->id) as $role => $role_info) {
            $roles[] = $role;
        }
        return $roles[0] ?? null;
    }

    public function getRoles() {
        return \Yii::$app->authManager->getRolesByUser($this->id);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
    
        if ($this->scenario == 'update') {
            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole($this->role);
            $auth->revokeAll($this->id);
            $auth->assign($authorRole, $this->id);
        }

        return true;
    }
}
