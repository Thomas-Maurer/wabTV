<?php

echo $this->Form->create('smileysUser');
echo '<h2>Utilisateurs</h2>';
echo $this->Form->select(
    'userId',
    $users,
    ['empty' => '(choisissez)']
);

echo '<h2>Smileys</h2>';
echo $this->Form->select(
    'smileysId',
    $smileys,
    ['empty' => '(choisissez)']
);
echo $this->Form->button('Autoriser');
echo $this->Form->end();