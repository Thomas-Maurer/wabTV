<?php
use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
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
        $this->execute("CREATE TABLE users
        (
            id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
            username VARCHAR(128),
            password VARCHAR(128),
            email VARCHAR(128),
            created DATETIME,
            modified DATETIME,
            status TINYINT DEFAULT 1 NOT NULL
        );
");
    }
}
