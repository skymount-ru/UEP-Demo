<?php

namespace frontend\modules\api\controllers;

use common\models\User;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class UserController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\User';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'except' => ['create'],
        ];

        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        /** @var User $user */
        $user = \Yii::$app->user->identity;

        switch ($action) {
            case 'delete':
                if (!$user->isAdmin) {
                    throw new ForbiddenHttpException();
                }
        }
    }
}
