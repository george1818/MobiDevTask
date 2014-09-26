<?php

class m140924_181428_create_likes_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('like_repo', array(
            'id' => 'pk',
            'id_repo' => 'VARCHAR(11)'
        ));
        $this->createTable('like_users',array(
            'id' => 'pk',
            'id_user' => 'VARCHAR(11)'
        ));
	}

	public function down()
	{
        $this->dropTable('like_repo');
        $this->dropTable('like_users');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}