<?php
    echo $this->Form->create('Smiley', ['type' => 'file']);
    echo $this->Form->input('Smiley.submittedSmiley', [
        'type' => 'file'
    ]);
    echo $this->Form->input('Smiley.name');
    echo $this->Form->input('Smiley.comment');
    echo $this->Form->button('Ajouter');
    echo $this->Form->end();
?>