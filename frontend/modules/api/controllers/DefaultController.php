<?php

namespace frontend\modules\api\controllers;

use common\models\User;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\Controller;

class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
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

    /**
     * @return array
     */
    public function actionLogin()
    {
        $user = \Yii::$app->user->identity;
        $user->generateAccessToken();
        $user->save();

        return ['token' => $user->access_token];
    }
}
