<?php


echo $this->Html->link(
    'Ajouter un smiley',
    ['controller' => 'Smileys', 'action' => 'create']
);

echo $this->Html->link(
    'Liste Smileys',
    ['controller' => 'Smileys', 'action' => 'listAll']
);

echo $this->Html->link(
    'Authoriser un smiley à un utilisateur',
    ['controller' => 'Smileys', 'action' => 'associateSmileyToUser']
);
