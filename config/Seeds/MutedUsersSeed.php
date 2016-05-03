<?php
use Phinx\Seed\AbstractSeed;

/**
 * ChatUsersMuted seed.
 */
class MutedUsersSeed extends AbstractSeed
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
            'id'=> 1,
            'user_id' => 1,
            'global' => 0,
            'username_muted' => 'test_user2'
        ]
        ];

        $table = $this->table('muted_users');
        $table->insert($data)->save();
    }
}
