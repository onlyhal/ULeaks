<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "districts".
 *
 * @property integer $id
 * @property string $name
 * @property integer $id_country
 */
class Districts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'districts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id_country'], 'required'],
            [['id_country'], 'integer'],
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
            'id_country' => 'Id Country',
        ];
    }
}
