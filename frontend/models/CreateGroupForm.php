<?php


namespace frontend\models;


use yii\base\Model;

class CreateGroupForm extends Model
{
    public $title;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['title', 'required'],
            ['title', 'string', 'max' => 200, 'min' => 3],
        ];
    }
}