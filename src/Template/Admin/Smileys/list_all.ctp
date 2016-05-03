<?php

//var_dump( $smileys);

echo '<table>';
echo $this->Html->tableHeaders(['Nom', 'Url', 'Image', 'Id']);

foreach ($smileys as $smiley) {
    echo $this->Html->tableCells([
        [$smiley->name, $smiley->url, $this->Html->image('/img/'.$smiley->url, array('alt'=>'whisper')),$smiley->id]
    ]);
}
echo '</table>';
