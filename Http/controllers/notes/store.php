<?php

(new \Http\controllers\NotesController())-> store();

header('location: /notes');
die();
