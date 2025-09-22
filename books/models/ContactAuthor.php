<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact_author".
 *
 * @property int $id_contact
 * @property int $id_author
 */
class ContactAuthor extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact_author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_contact', 'id_author'], 'required'],
            [['id_contact', 'id_author'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_contact' => 'Id Contact',
            'id_author' => 'Id Author',
        ];
    }

}
