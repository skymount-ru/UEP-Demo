<?php

namespace common\models\db;

use common\models\GroupChatMessage;
use common\models\GroupMember;
use common\models\User;
use Yii;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property string $title
 *
 * @property GroupChatMessage[] $groupChatMessages
 * @property GroupMember[] $groupMembers
 * @property User[] $users
 */
class BaseGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[GroupChatMessages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupChatMessages()
    {
        return $this->hasMany(GroupChatMessage::className(), ['group_id' => 'id']);
    }

    /**
     * Gets query for [[GroupMembers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupMembers()
    {
        return $this->hasMany(GroupMember::className(), ['group_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('group_member', ['group_id' => 'id']);
    }
}
