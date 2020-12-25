<?php

namespace Madam;

class CID
{
    private $table;
    private $db;

    function __construct()
    {
        $this->db = new Database();
        $this->table = $_ENV['CID_TABLE'];
    }

    public function getCIDs()
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

    public function getCIDsTotal()
    {
        $total = count($this->getCIDs());

        return $total;
    }

    public function getCIDById($id)
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

    public function searchCID($key)
    {
        $data = [];
        $keyFormat = "%" . $key . "%";

        $stmt = $this->db->getConnection()->prepare("SELECT * FROM {$this->table} WHERE
            cid LIKE ? OR
            service_name LIKE ? OR
            customer_name LIKE ? OR
            location LIKE ? OR
            rack_location LIKE ? OR
            u_location LIKE ?");

        $stmt->bind_param('ssssss', 
            $keyFormat,
            $keyFormat,
            $keyFormat,
            $keyFormat,
            $keyFormat,
            $keyFormat
        );

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

    public function addCID($param)
    {
        $stmt = $this->db->getConnection()->prepare("INSERT INTO {$this->table} (cid, service_name, customer_name, location, rack_location, u_location)
            VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->bind_param(
            'ssssss',
            $param['cid'],
            $param['service_name'],
            $param['customer_name'],
            $param['location'],
            $param['rack_location'],
            $param['u_location']
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

    public function updateCID($id, $param = [])
    {
        $set = '';
        $argV = [];
        $types = '';

        foreach ($param as $k => $v) {
            $set .= "$k = ?, ";
            $types .= 's';

            array_push($argV, $v);
        }

        array_push($argV, $id);

        $types .= 'i';

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
            $this->db->getConnection()->close();

            return true;
        }
    }

    public function removeCID($id)
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
