<?php

namespace app\controllers;

use app\models\Book;
use app\models\Contact;
use app\models\SignupModel;
use app\models\SignupSearch;
use Yii;
use yii\db\Query;
use yii\web\Controller;
use yii\web\Cookie;

class SignupController extends Controller
{
    public function actionIndex()
    {
        $book = new Book();
        $searchModel = new SignupSearch();

        $years = [];
        $query = new Query();
        $searchBooks = $query
            ->select([
                'book.issue_year',
                'author.name',
                'author.id',
                'COUNT(book.id) AS books_written',
            ])
            ->from('author')
            ->innerJoin('book_author', 'book_author.id_author = author.id')
            ->innerJoin('book', 'book.id = book_author.id_book')
            ->where('book.issue_year IS NOT NULL')
            ->groupBy('author.id, book.issue_year')
            ->orderBy(['books_written' => SORT_DESC])
            ->all()
        ;

        foreach ($searchBooks as $key => $searchBook) {
            $years[$searchBook['issue_year']] = $searchBook['issue_year'];
        }

        $params = isset(Yii::$app->request->queryParams['Book']['issue_year'])
           ? Yii::$app->request->queryParams
           : [
                'r' => 'signup/index',
                'Book' => [
                    'issue_year' => current($years)
                ]
            ]
        ;
        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'book' => $book,
            'years' => $years,
        ]);
    }

    public function actionSignup()
    {
        $authorId = $this->request->getQueryParam('id');
        if (
            Yii::$app->request->cookies->has('user_id')
        )
        {
            $guestToken = Yii::$app->request->cookies->getValue('user_id');
        } else {
            $guestToken = Contact::find()
                ->orderBy(['guest_token' => SORT_DESC])
                ->one()
                ->guest_token + 1
            ;

            $cookie = new Cookie([
                'name' => 'user_id',
                'value' => $guestToken,
                'expire' => time() + 86400,
//                'domain' => '.example.com', // Optional: for cross-subdomain access
//                'httpOnly' => true, // Optional: prevents client-side JavaScript access
//                'secure' => true, // Optional: only send over HTTPS
//                'sameSite' => Cookie::SAME_SITE_LAX, // Optional: SameSite policy
            ]);
            Yii::$app->response->cookies->add($cookie);

        }

        $contact = Contact::find()
            ->where(['guest_token' => $guestToken])
            ->one()
        ;

        if ($contact) {
            if (
                (new SignupModel())->signup($contact, $authorId)
            )
            {
                Yii::$app->session->setFlash('success', 'Subscribed');
            } else {
                Yii::$app->session->setFlash('warning', 'Already subscribed');
            }

            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->redirect(
                'index.php?r=contact%2Fcreate&author_id=' . $authorId . '&token=' . $guestToken
            );
        }
    }
}