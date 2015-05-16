<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "universities".
 *
 * @property integer $id
 * @property string $name
 * @property integer $id_city
 */
class Universities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'universities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id_city'], 'required'],
            [['id_city'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'id_city' => 'Id City',
        ];
    }
}
