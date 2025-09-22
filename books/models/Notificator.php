<?php

namespace app\models;

use app\components\BookPublishEvent;
use Yii;
use yii\base\Model;
use yii\db\Query;
use yii\helpers\VarDumper;

class Notificator extends Model
{
    public static function notify(Contact $contact, Book $book): void
    {
        $text = $book->getAuthorsList() . ' issued a new book titled ' . $book->name;

        Yii::$app->mailer->compose()
            ->setFrom('from@domain.com')
            ->setTo($contact->name)
            ->setSubject('A new book by your author of interest is published')
            ->setTextBody($text)
//                    ->setHtmlBody('<b>HTML content</b>')
            ->send();

//        Yii::$app->session->setFlash(
//            'success',
//            $contact->name . ' notified'
//        );
        Yii::$app->session->addFlash(
            'notifications',
            $contact->name . ' notified'
        );
    }

}