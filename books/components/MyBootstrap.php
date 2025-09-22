<?php

namespace app\components;

use app\controllers\BookController;
use app\models\Contact;
use app\models\Notificator;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\db\Query;

class MyBootstrap implements BootstrapInterface
{
    public function bootstrap($app): void
    {
        Event::on(
            BookController::class,
            BookController::EVENT_NEW_BOOK_ADDED,
            function (BookPublishEvent $event) {
                $contacts = (new Query())
                    ->select(['contact.id'])
                    ->from('book')
                    ->innerJoin('book_author', 'book_author.id_book = book.id')
                    ->innerJoin('author', 'author.id = book_author.id_author')
                    ->innerJoin('contact_author', 'contact_author.id_author = author.id')
                    ->innerJoin('contact', 'contact.id = contact_author.id_contact')
                    ->where(['book.id' => $event->book->id])
                    ->distinct()
                    ->column()
                ;
                $contacts = Contact::find()
                    ->where(['IN', 'id', $contacts])
                    ->all()
                ;

//                $contacts = Contact::find()
//                    ->with([
//                        'authors.books' => function ($query) use ($event) {
//                            $query->where(['book.id' => $event->book->id]);
//                        }
//                    ])
//                    ->all()
//                ; // todo: select only those to notify

                foreach ($contacts as $contact) {
                (new Notificator())->notify($contact, $event->book);
                }

//                (new Notificator())->notify($event->book);
            }
        );

    }
}