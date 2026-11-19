<?php

$notes = (new Http\controllers\NotesController)->index();

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);