<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Products".
 *
 * @property string $ASIN
 * @property string $Title
 * @property string $Price
 * @property string $Picture
 * @property string $EAN
 * @property string $Brand
 * @property int $id
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ASIN', 'Title', 'Price', 'EAN', 'Brand'], 'string', 'max' => 255],
            [['Picture'], 'string', 'max' => 2083],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ASIN' => 'Asin',
            'Title' => 'Title',
            'Price' => 'Price',
            'Picture' => 'Picture',
            'EAN' => 'Ean',
            'Brand' => 'Brand',
        ];
    }
}
