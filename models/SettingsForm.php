<?php
namespace app\models;

use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SettingsForm extends Model
{
    public $username;
    public $email;
    public $password;

    private $_userBase = "";
    private $_user = false;

    public function __construct() {
        parent::__construct();
        $this->_userBase = Yii::$app->user->identity->username;
        $this->username = Yii::$app->user->identity->username;
        $this->email = Yii::$app->user->identity->email;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password', 'validatePassword'],
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
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function save1()
    {
        if ($this->validate()) {
            $this->_user->username = $this->username;
            $this->_user->email = $this->email;
            return $this->_user->save(false);
        }
    
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->_userBase);
        }

        return $this->_user;
    }
}