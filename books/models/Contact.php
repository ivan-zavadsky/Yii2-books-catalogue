<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $guest_token
 */
class Contact extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'guest_token'], 'required'],
            [['name', 'type', 'guest_token'], 'string', 'max' => 256],
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
            'type' => 'Type',
            'guest_token' => 'Guest Token',
        ];
    }

    public function getAuthors(): ActiveQuery
    {
        return $this->hasMany(
            Author::class,
            ['id' => 'id_author']
        )->viaTable
        (
            'contact_author',
            ['id_contact' => 'id']
        );
    }

}
