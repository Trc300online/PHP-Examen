<?php

$note = (new Http\controllers\NotesController)->edit();

view("notes/edit.view.php", [
    'heading' => 'Edit Note',
    'errors' => [],
    'note' => $note
]);