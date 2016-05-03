<?php
use Phinx\Seed\AbstractSeed;

/**
 * Users seed.
 */

use Cake\Auth\DefaultPasswordHasher;

class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {

        $data = [
          [
            'id' => 1,
            'username' => 'test_user',
            'password' => (new DefaultPasswordHasher)->hash('test1234'),
            'email' => 'test@mail.com',
            'status' => '0'
          ],
          [
            'id' => 2,
            'username' => 'test_user2',
            'password' => (new DefaultPasswordHasher)->hash('test1234'),
            'email' => 'test@mail.com',
            'status' => '0'
          ],
          [
            'id' => 3,
            'username' => 'test_admin',
            'password' => (new DefaultPasswordHasher)->hash('test1234'),
            'email' => 'test@mail.com',
            'status' => '2'
          ],
        ];;

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
