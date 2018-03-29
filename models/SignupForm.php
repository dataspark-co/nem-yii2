<?php
namespace app\models;

use yii\base\Model;

/**
 * Class SignupForm
 * @package app\models
 */
class SignupForm extends Model
{
    public $username;
    public $password;
    public $confirm_password;
    protected $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['password', 'required'],
            ['password', 'string', 'min' => 8],
            ['password', 'compare', 'compareAttribute' => 'confirm_password'],
            ['confirm_password', 'required'],
            ['confirm_password', 'string', 'min' => 8],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
            'confirm_password' => 'Confirm password'
        ];
    }

    /**
     * @return User|bool
     * @throws \yii\base\Exception
     */
    public function signup()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if(!$user->generateNemWallet()) {
            return false;
        }

        return $user->save() ? $user : false;
    }
}
