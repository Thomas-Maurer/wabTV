<?php
use Migrations\AbstractMigration;

class CreateSmileysUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('smileys_users');
        $table->addColumn('smileys_available','text');
        $table->addColumn('user_id','integer' ,['signed' => false])
          ->addForeignKey('user_id', 'users', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $table->create();
    }
}
