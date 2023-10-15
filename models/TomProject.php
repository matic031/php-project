<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tom_project".
 *
 * @property int $id
 * @property string|null $name
 */
class TomProject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tom_project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        // return [
        //     [['id'], 'required'],
        //     [['id'], 'integer'],
        //     [['name'], 'string'],
        //     [['id'], 'unique'],
        // ];

        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
}