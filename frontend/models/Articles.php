<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $date
 * @property integer $id_user
 * @property integer $id_university
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'date', 'id_user', 'id_university'], 'required'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['id_user', 'id_university'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'date' => 'Date',
            'id_user' => 'Id User',
            'id_university' => 'Id University',
        ];
    }
}
