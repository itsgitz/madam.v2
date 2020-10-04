<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;

class User
{
    private $table;
    private $db;

    function __construct()
    {
        $this->db = new Database();
        $this->table = $_ENV['USER_TABLE'];
    }

    public function getUsers()
    {
        $data = [];
        $query  = "SELECT * FROM {$this->table}";
        $result = $this->db->getConnection()->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
            $this->db->getConnection()->close();
            
            return $data;
        } else {
            return null;
        }
    }

    public function getUserById($id)
    {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $this->db->getConnection()->close();

            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function getUserByUsername($username)
    {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM {$this->table} WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();
            $this->db->getConnection()->close();

            return $data;
        } else {
            return null;
        }
    }

    public function addUser($param = [])
    {
        $stmt = $this->db->getConnection()->prepare("INSERT INTO {$this->table} (name, username, password, email, activated, user_role)
            VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->bind_param('ssssss', $param['name'], $param['username'], $param['password'], $param['email'], $param['activated'], $param['user_role']);

        $success = $stmt->execute();

        if (!$success) {
            $this->db->getConnection()->close();

            return false;
        } else {
            return true;
        }
    }

    public function updateUser($id, $param = [])
    {
        $set    = '';
        $argV   = [];
        $types  = '';

        // set the `SET` directive for update query
        foreach ($param as $k => $v) {
            $set    .= "$k = ?, ";
            $types  .= 's';
            
            array_push($argV, $v);
        }

        // id for the last argument
        array_push($argV, $id);

        // add integer for id
        $types .= 'i';

        // remove last comma
        $update = rtrim($set, ', ');

        $stmt = $this->db->getConnection()->prepare("UPDATE {$this->table}
            SET $update
            WHERE id = ?");
        
        $stmt->bind_param($types, ...$argV);
        $success = $stmt->execute();

        if (!$success) {
            $this->db->getConnection()->close();

            return false;
        } else {
            return true;
        }
    }

    public function removeUser($id)
    {
        $stmt = $this->db->getConnection()->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->bind_param('i', $id);

        $success = $stmt->execute();

        if (!$success) {
            $this->db->getConnection()->close();

            return false;
        } else {
            return true;
        }
    }
}
