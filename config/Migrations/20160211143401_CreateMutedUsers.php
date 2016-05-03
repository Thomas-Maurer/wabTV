<?php
use Migrations\AbstractMigration;

class CreateMutedUsers extends AbstractMigration
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
        $table = $this->table('muted_users');
        $table->addColumn('global', 'boolean', ['limit' => 2]);
        $table->addColumn('username_muted', 'text', ['limit' => 128]);
        $table->addColumn('user_id','integer' ,['signed' => false])
            ->addForeignKey('user_id', 'users', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'));
        $table->create();
    }
}
