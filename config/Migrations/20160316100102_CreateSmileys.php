<?php
use Migrations\AbstractMigration;

class CreateSmileys extends AbstractMigration
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
        $table = $this->table('smileys');
        $table->addColumn('name', 'text');
        $table->addColumn('url', 'text');
        $table->addColumn('comment', 'text');
        $table->create();
    }
}
