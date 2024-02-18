<?php

namespace app\modules\parking\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class SettingsForm extends Model
{
    public $site_name;
    public $name;
    public $address;
    public $phone;
    public $mobile;
    public $dni;
    public $schedule;
    public $regulations;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [
                [
                    'site_name',
                    'name',
                    'address',
                    'phone',
                    'mobile',
                    'dni',
                    'schedule',
                    'regulations',
                ],
                'required'
            ],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'site_name' => 'Nombre del sitio web',
            'name' => 'Nombre del parqueadero',
        ];
    }
}
