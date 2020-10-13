<?php

use yii\db\Migration;
use app\models\Contact;
use app\models\Comment;

/**
 * Class m201012_102437_insert_test_data_to_tables
 */
class m201012_102437_insert_test_data_to_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $contact_data = [
            ['id' => 1, 'email' => 'test1@mail.ru'],
            ['id' => 2, 'email' => 'test2@mail.ru'],
            ['id' => 3, 'email' => 'test3@mail.ru'],
        ];
        
        $comment_data = [
            ['id' => 1, 'contact_id' => 1, 'text' => 'Comment comment comment 1'],
            ['id' => 2, 'contact_id' => 1, 'text' => 'Comment comment comment 2'],
            ['id' => 3, 'contact_id' => 1, 'text' => 'Comment comment comment 3'],
    
            ['id' => 4, 'contact_id' => 2, 'text' => 'Comment comment comment 1'],
            ['id' => 5, 'contact_id' => 2, 'text' => 'Comment comment comment 2'],
            ['id' => 6, 'contact_id' => 2, 'text' => 'Comment comment comment 3'],
    
            ['id' => 7, 'contact_id' => 3, 'text' => 'Comment comment comment 1'],
            ['id' => 8, 'contact_id' => 3, 'text' => 'Comment comment comment 2'],
            ['id' => 9, 'contact_id' => 3, 'text' => 'Comment comment comment 3'],
    
            ['id' => 10, 'contact_id' => 3, 'text' => 'Comment comment comment 2'],
            ['id' => 11, 'contact_id' => 1, 'text' => 'Comment comment comment 1'],
            ['id' => 12, 'contact_id' => 2, 'text' => 'Comment comment comment 2'],
            ['id' => 13, 'contact_id' => 1, 'text' => 'Comment comment comment 3'],
            ['id' => 14, 'contact_id' => 3, 'text' => 'Comment comment comment 1'],
            ['id' => 15, 'contact_id' => 2, 'text' => 'Comment comment comment 1'],
            ['id' => 16, 'contact_id' => 1, 'text' => 'Comment comment comment 2'],
            ['id' => 17, 'contact_id' => 2, 'text' => 'Comment comment comment 3'],
            ['id' => 18, 'contact_id' => 3, 'text' => 'Comment comment comment 3'],
        ];
        
        foreach ($contact_data as $contact) {
            $model = new Contact();
    
            $model->id = $contact['id'];
            $model->email = $contact['email'];
            
            if($model->save()) {
                print('insert contact = ' . $contact['email'] . "\n");
            }
            else {
                print_r($model->getErrors());
            }
        }

        foreach ($comment_data as $comment) {
            $model = new Comment();
        
            $model->id = $comment['id'];
            $model->contact_id = $comment['contact_id'];
            $model->text = $comment['text'];
        
            if($model->save()) {
                print('insert comment = ' . $comment['text'] . "\n");
            }
            else {
                print_r($model->getErrors());
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $ids = range(1, 18, 1);
    
        Comment::deleteAll(['id' => $ids]);

        $ids = range(1, 3, 1);
        
        Contact::deleteAll(['id' => $ids]);
    }
}
