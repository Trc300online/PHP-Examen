<?php

namespace Core\DAO;

use Core\Database;

class NotesDAOImpl implements NotesDAO
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }


    public function getAllByUser($userId)
    {
        return $this->db->query(
            'SELECT * FROM notes WHERE user_id = :user_id',
            ["user_id" => $userId]
        )->get();
    }

    public function findById($id)
    {
        return $this->db->query(
            'SELECT * FROM notes WHERE id = :id',
            ["id" => $id]
        )->get();
    }

    public function create($body, $userID)
    {
        return $this->db->query(
            'INSERT INTO notes (body, user_id)
             VALUES (:body, :user_id)',
            ["body" => $body,
            "user_id" => $userID]
        );
    }

    public function update($id, $body)
    {
        return $this->db->query(
            'UPDATE notes SET body = :body WHERE id = :id',
            ["body" => $body,
            "id" => $id]
        );
    }

    public function delete($id)
    {
        return $this->db->query(
            'DELETE FROM notes WHERE id = :id',
            ['id' => $id]
        );
    }

    public function getUserIdByEmail($email)
    {
        $user = $this->db->query(
            'SELECT id FROM users WHERE email = :email',
            ["email" => $email]
        )-> find();

        return $user ? (int) $user["id"] : null;
    }
}