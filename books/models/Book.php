<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\UploadedFile;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $name
 * @property int|null $issue_year
 * @property string|null $description
 * @property string|null $isbn
 * @property string|null $photo_url
 * @property UploadedFile|null $imageFile
 */
class Book extends ActiveRecord
{
    public $imageFile;
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['issue_year', 'description', 'isbn', 'photo_url'], 'default', 'value' => null],
            [['name'], 'required'],
            [['issue_year'], 'integer'],
            [['description'], 'string'],
            [['name', 'isbn', 'photo_url'], 'string', 'max' => 256],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpeg']
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
            'issue_year' => 'Issue Year',
            'description' => 'Description',
            'isbn' => 'Isbn',
            'photo_url' => 'Photo Url',
        ];
    }

    public function getAuthors(): ActiveQuery
    {
        return $this->hasMany(
            Author::class,
            ['id' => 'id_author']
        )->viaTable
        (
            'book_author',
            ['id_book' => 'id']
        );
    }

    /**
     * {@inheritdoc}
     * @return BookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BookQuery(get_called_class());
    }

    public function getAuthorsList(): string
    {
        return implode(', ', array_map(
            function ($item) {
                return $item->name;
            },
            $this->authors
        ));
    }

    public function upload()
    {
        if (
            $this->validate()
        ) {
            $this->imageFile->saveAs(
                'runtime/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension
            );
            return true;
        } else {
            return false;
        }
    }

}
