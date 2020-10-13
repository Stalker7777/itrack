<?php

namespace app\components;

use app\models\Contact;

class Helper
{
    public function getContactID($contact_email = null)
    {
        if($contact_email == null) return -1;
        
        $contact = Contact::find()->where(['email' => $contact_email])->one();
        
        if($contact !== null) {
            return $contact->id;
        }
        
        $result = $this->createContact($contact_email);
        
        if($result > 0) {
            return $result;
        }
        
        return -1;
    }
    
    private function createContact($contact_email = null)
    {
        if($contact_email == null) return -1;
        
        $contact = new Contact();
    
        $contact->email = $contact_email;
        
        if($contact->save()) {
            return $contact->id;
        }
        
        return -1;
    }

}