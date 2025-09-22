<?php

namespace app\models;

use yii\base\Model;

class SignupModel extends Model
{
    public function signup(Contact $contact, int $authorId)
    {
        $link = (bool) ContactAuthor::find()
            ->where([
                'id_author' => $authorId,
                'id_contact' => $contact->id
            ])->one()
        ;

        if (!$link) {
            $link = new ContactAuthor();
            $link->id_author = $authorId;
            $link->id_contact = $contact->id;
            $link->save();

            return true;
        }

        return false;
    }
}