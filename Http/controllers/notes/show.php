<?php

$note = (new Http\controllers\NotesController)->show();

view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note
]);
