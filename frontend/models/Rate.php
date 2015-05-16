<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rate".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_article
 */
class Rate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_article'], 'required'],
            [['id_user', 'id_article'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_article' => 'Id Article',
        ];
    }
}
