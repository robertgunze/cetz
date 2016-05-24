<?php 
namespace App\Model\Table;

use Cake\Auth\DigestAuthenticate;
use Cake\Event\Event;
use Cake\ORM\Table;


class UsersTable extends Table{
    
    public function beforeSave(Event $event){
        
        $entity = $event->data['entity'];
        $entity->digest_hash = DigestAuthenticate::password(
             $entity->username,
             $entity->plain_password,
             env('SERVER_NAME')
            );
        
        return true;
    }
}

?>