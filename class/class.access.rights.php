<?php

namespace Madam;

class AccessRights
{
    private $table;
    private $db;

    function __construct()
    {
        $this->db = new Database();
        $this->table = $_ENV['ACCESS_RIGHTS_TABLE'];
    }

    public function getAccessRights()
    {
        $data = [];
        $query = "SELECT * FROM {$this->table}";
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

    public function getAccessRightById($id)
    {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $this->db->getConnection()->close();

            return $data;
        } else {
            $this->db->getConnection()->close();

            return null;
        }
    }

    public function searchAccessRights($key)
    {
        $data = [];
        $keyFormat = "%" . $key . "%";

        $stmt = $this->db->getConnection()->prepare("SELECT * FROM {$this->table} WHERE
            name LIKE ? OR
            company_name LIKE ? OR
            identity_number LIKE ? OR
            email LIKE ? OR");

        $stmt->bind_param('ssss', $keyFormat, $keyFormat, $keyFormat, $keyFormat);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
            $this->db->getConnection()->close();

            return $data;
        } else {
            $this->db->getConnection()->close();

            return null;
        }
    }

    public function addAccessRight($param = [])
    {
        $stmt = $this->db->getConnection()->prepare("INSERT INTO {$this->table} (customer_id, name, company_name, identity_number, email)
            VALUES (?, ?, ?, ?, ?)");

        $stmt->bind_param(
            'issss',
            $param['customer_id'],
            $param['name'],
            $param['company_name'],
            $param['identity_number'],
            $param['email']
        );

        $success = $stmt->execute();

        if (!$success) {
            $this->db->getConnection()->close();

            return false;
        } else {
            $this->db->getConnection()->close();

            return true;
        }
    }

    public function updateAccessRight($id, $param = [])
    {
        $set    = '';
        $argV   = [];
        $types  = '';

        foreach ($param as $k => $v) {
            $set    .= "$k = ?, ";
            $types  .= 's';

            array_push($argV, $v);
        }

        array_push($argV, $id);

        $types .= 'i';

        $update = rtrim($set, ', ');

        $stmt = $this->db->getConnection()->prepare("UPDATE {$this->table}
            SET $update
            WHERE id =?");

        $stmt->bind_param($types, ...$argV);
        $success = $stmt->execute();

        if (!$success) {
            $this->db->getConnection()->close();

            return false;
        } else {
            $this->db->getConnection()->close();

            return true;
        }
    }

    public function removeAccessRight($id)
    {
        $stmt = $this->db->getConnection()->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->bind_param('i', $id);

        $success = $stmt->execute();

        if (!$success) {
            $this->db->getConnection()->close();

            return false;
        } else {
            $this->db->getConnection()->close();

            return true;
        }
    }
}
