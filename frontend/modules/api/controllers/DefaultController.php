<?php

namespace frontend\modules\api\controllers;

use common\models\User;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\web\Controller;

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
                'only' => ['login'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'authenticator' => [
                'class' => HttpBasicAuth::class,
                'auth' => function ($username, $password) {
                    $user = User::findByUsername($username);
                    if ($user && $user->validatePassword($password)) {
                        return $user;
                    }
                },
            ],
        ];
    }

    public function actionLogin()
    {
        \Yii::$app->user->identity->generateAccessToken();
        return $this->asJson(['token' => \Yii::$app->user->identity->access_token]);
    }
}
