<?php


namespace frontend\composers;


use common\models\Group;
use common\models\GroupChatMessage;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\ListView;

class IndexComposer
{
    protected $data = [];
    protected $groupId;
    /**
     * @var User
     */
    protected $user;

    public function viewData()
    {
        return $this->data;
    }

    public function __construct()
    {
        $this->groupId = \Yii::$app->request->get('group_id');
        $this->user = \Yii::$app->user->identity;
        $this->data['groups'] = $this->renderGroups();
        $this->data['messages'] = $this->renderMessages();
    }

    private function renderGroups(): string
    {
        return ListView::widget([
            'dataProvider' => new ActiveDataProvider(['query' => Group::find()]),
            'itemView' => function ($model) {
                $addUser = Html::button('+User', [
                    'class' => 'btn btn-warning _add-user',
                    'data' => ['toggle' => 'modal', 'target' => '#add-user', 'id' => $model->id, 'name' => $model->title],
                ]);
                return '<div class="btn-group">' . Html::a($model->title,
                    ['site/index', 'group_id' => $model->id],
                    ['class' => 'btn ' . (@$_GET['group_id'] == $model->id ? 'btn-danger' : 'btn-info'), 'style' => 'width: 140px;']
                ) . $addUser . '</div>';
            },
            'layout' => '{items}',
        ]);
    }

    private function renderMessages(): string
    {
        return ListView::widget([
            'dataProvider' => new ActiveDataProvider([
                'query' => GroupChatMessage::find()->where(['group_id' => $this->groupId]),
                'pagination' => false,
            ]),
            'itemView' => function ($model) {
                /**
                 * @var GroupChatMessage $model
                 */
                return sprintf('<div><b>%s:</b> <span>%s</span></div>',
                    $model->user ? $model->user->username : 'Robot',
                    $model->message
                );
            },
            'layout' => '{items}',
        ]);
    }
}