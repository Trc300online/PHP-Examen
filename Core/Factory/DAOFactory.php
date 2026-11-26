<?php

use Core\App;
use Core\DAO\NotesDAO;
use Core\Database;
use Core\DAO\NotesDAOImpl;

class DAOFactory
{
    public static function createNotesDAO(): NotesDAO
    {
        $db = App::resolve(Database::class);

        return new NotesDAOImpl($db);
    }
}