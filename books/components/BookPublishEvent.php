<?php

namespace app\components;

use app\models\Author;
use app\models\Book;
use yii\base\Event;

class BookPublishEvent extends Event
{
    public Book $book;
}