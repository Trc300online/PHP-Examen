<?php

namespace Core\DAO;

interface NotesDAO
{
    public function getAllByUser($userId);

    public function findById($id);

    public function create($body, $userID);

    public function update($id, $body);

    public function delete($id);
}