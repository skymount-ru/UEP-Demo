<?php


namespace frontend\controllers;


use common\models\Group;
use common\models\GroupChatMessage;
use common\models\GroupMember;
use frontend\models\AddUserForm;
use frontend\models\CreateGroupForm;
use frontend\models\SendMessageForm;
use yii\filters\AccessControl;
use yii\web\Controller;

class ChatController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionCreateGroup()
    {
        $model = new CreateGroupForm();
        if ($model->load(\Yii::$app->request->post())) {
            $group = new Group([
                'title' => $model->title,
            ]);
            $group->save();
        }

        return $this->redirect(\Yii::$app->request->referrer ?: ['/']);
    }

    public function actionAddUser()
    {
        $model = new AddUserForm();
        if ($model->load(\Yii::$app->request->post())) {
            $group = new GroupMember([
                'user_id' => $model->user_id,
                'group_id' => $model->group_id,
            ]);
            $group->save();
        }

        return $this->redirect(\Yii::$app->request->referrer ?: ['/']);
    }

    public function actionSendMessage()
    {
        $model = new SendMessageForm();
        if ($model->load(\Yii::$app->request->post())) {
            GroupChatMessage::post($model->group_id, $model->message, \Yii::$app->user->id);
        }

        return $this->redirect(\Yii::$app->request->referrer ?: ['/']);
    }
}