<?php


namespace frontend\modules\api\models;


class User extends \common\models\User
{
    public $password;

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function fields()
    {
        return [
            'id',
            'username',
            'email',
        ];
    }

    public function beforeSave($insert)
    {
        $this->setPassword($this->password);
        $this->generateAuthKey();
        $this->generateAccessToken();
        $this->generateEmailVerificationToken();

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}