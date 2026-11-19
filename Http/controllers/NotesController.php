<?php

namespace Http\controllers;

use Core\App;
use Core\Database;
use Core\Validator;

class NotesController
{
    function destroy()
    {
        $db = App::resolve(Database::class);

        $currentUserId = $this->currentUserId();

        $note = $db->query('select * from notes where id = :id', [
            'id' => $_POST['id']
        ])->findOrFail();

        authorize($note['user_id'] === $currentUserId);

        $db->query('delete from notes where id = :id', [
            'id' => $_POST['id']
        ]);
    }

    function edit()
    {
        $db = App::resolve(Database::class);

        $currentUserId = $this->currentUserId();

        $note = $db->query('select * from notes where id = :id', [
            'id' => $_GET['id']
        ])->findOrFail();

        authorize($note['user_id'] === $currentUserId);

        return $note;
    }

    function index()
    {
        $db = App::resolve(Database::class);

        $notes = $db->query('select * from notes where user_id = :currentUserId', [
            'currentUserId' => $this->currentUserId()
        ])->get();

        return $notes;
    }

    function show()
    {
        $db = App::resolve(Database::class);

        $currentUserId = $this->currentUserId();

        $note = $db->query('select * from notes where id = :id', [
            'id' => $_GET['id']
        ])->findOrFail();

        authorize($note['user_id'] === $currentUserId);

        return $note;
    }

    function store()
    {
        $db = App::resolve(Database::class);
        $errors = [];

        if (! Validator::string($_POST['body'], 1, 1000)) {
            $errors['body'] = 'A body of no more than 1,000 characters is required.';
        }

        if (! empty($errors)) {
            return view("notes/create.view.php", [
                'heading' => 'Create Note',
                'errors' => $errors
            ]);
        }

        $db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
            'body' => $_POST['body'],
            'user_id' => 1
        ]);

        return header('location: /notes');
    }

    function update()
    {
        $db = App::resolve(Database::class);

        //dd($_SESSION);

        $currentUserId = $this->currentUserId();

        $note = $db->query('select * from notes where id = :id', [
            'id' => $_POST['id']
        ])->findOrFail();

        authorize($note['user_id'] === $currentUserId);

        $errors = [];

        if (! Validator::string($_POST['body'], 1, 10)) {
            $errors['body'] = 'A body of no more than 1,000 characters is required.';
        }

        if (count($errors)) {
            return view('notes/edit.view.php', [
                'heading' => 'Edit Note',
                'errors' => $errors,
                'note' => $note
            ]);
        }

        $db->query('update notes set body = :body where id = :id', [
            'id' => $_POST['id'],
            'body' => $_POST['body']
        ]);
    }

    function currentUserId()
    {
        $db = App::resolve(Database::class);

        return $db-> query('select id from users where email = :email', [
            'email' => $_SESSION['user']['email']
        ]);
    }
}