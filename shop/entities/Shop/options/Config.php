<?php

namespace shop\entities\Shop\options;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property string $id
 * @property string $param
 * @property string $value
 * @property string $default
 * @property string $label
 * @property string $type
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'param', 'value', 'default', 'label', 'type'], 'required'],
            [['id'], 'integer'],
            [['value', 'default'], 'string'],
            [['param', 'type'], 'string', 'max' => 128],
            [['label'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'param' => 'Param',
            'value' => 'Value',
            'default' => 'Default',
            'label' => 'Label',
            'type' => 'Type',
        ];
    }
}
