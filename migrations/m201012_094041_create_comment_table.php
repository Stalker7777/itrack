<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m201012_094041_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
    
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
    
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'contact_id' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->null(),
        ], $tableOptions);
        
        $this->createIndex('idx-comment-contact_id',
            '{{%comment}}',
            'contact_id'
        );
        
        $this->addForeignKey('fk-comment-contact_id-contact',
            '{{%comment}}',
            'contact_id',
            '{{%contact}}',
            'id'
        );
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-comment-contact_id-contact', '{{%comment}}');
        
        $this->dropIndex('idx-comment-contact_id', '{{%comment}}');
        
        $this->dropTable('{{%comment}}');
    }
}
