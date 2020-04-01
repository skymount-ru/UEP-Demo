<?php

namespace common\models\db;

use common\models\Group;
use common\models\User;
use Yii;

/**
 * This is the model class for table "group_chat_message".
 *
 * @property int $id
 * @property string|null $message
 * @property int $user_id
 * @property int $group_id
 * @property int $created_at
 *
 * @property Group $group
 * @property User $user
 */
class BaseGroupChatMessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_chat_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
            [['user_id', 'group_id', 'created_at'], 'required'],
            [['user_id', 'group_id', 'created_at'], 'integer'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => 'Message',
            'user_id' => 'User ID',
            'group_id' => 'Group ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
