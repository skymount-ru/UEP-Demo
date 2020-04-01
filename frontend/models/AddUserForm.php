<?php


namespace frontend\models;


use yii\base\Model;

class AddUserForm extends Model
{
    public $group_id;
    public $user_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'user_id'], 'required'],
            [['group_id', 'user_id'], 'integer'],
        ];
    }
}
