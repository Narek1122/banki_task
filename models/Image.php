<?php

namespace app\models;

class Image extends \yii\db\ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return 'images';
    }
}