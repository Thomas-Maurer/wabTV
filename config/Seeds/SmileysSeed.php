<?php
use Phinx\Seed\AbstractSeed;

/**
 * Smileys seed.
 */

use Cake\Auth\DefaultPasswordHasher;

class SmileysSeed extends AbstractSeed
{
  /**
   * Run Method.
   *
   * Write your database seeder using this method.
   *
   * More information on writing seeders is available here=>
   * http=>//docs.phinx.org/en/latest/seeding.html
   *
   * @return void
   */
  public function run()
  {

    $data = [
      [
        'id' => 1,
        'name' => 'weareBob',
        'url' => '/smileys/tetebobpauvre30.png',
        'comment' => 'tete we are bob ascii'
      ]
    ];

    $table = $this->table('smileys');
    $table->insert($data)->save();

    $data = [
      [
        "id" => 1,
        "smileys_available" => "[{\"id\": 1, \"name\": \"weareBob\", \"url\": \"/smileys/tetebobpauvre30.png\"}]",
        "user_id" => 1
      ]
    ];

    $table = $this->table('smileys_users');
    $table->insert($data)->save();

  }
}
