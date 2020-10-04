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

    public function getCIDById()
    {
        $this->db->getConnection()->close();
    }
}