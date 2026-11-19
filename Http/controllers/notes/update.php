<?php

(new \Http\controllers\NotesController())-> update();

// redirect the user
header('location: /notes');
die();
