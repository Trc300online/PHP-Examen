<?php

(new Http\controllers\NotesController)->destroy();


header('location: /notes');
exit();
