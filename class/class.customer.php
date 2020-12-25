<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;


class Customer
{
    private $table;
    private $db;

    function __construct()
    {
        $this->db = new Database();
        $this->table = $_ENV['CUSTOMER_TABLE'];
    }

    public function getCustomers()
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
            $this->db->getConnection()->close();

            return null;
        }
    }

    public function getCustomersTotal()
    {
        $total = \count($this->getCustomers());

        return $total;
    }

    public function getCustomerSegmentations()
    {
        $data = [];
        $query = "SELECT DISTINCT `segmentation` FROM {$this->table} ORDER BY `segmentation` ASC";
        $result = $this->db->getConnection()->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                \array_push($data, $row['segmentation']);
            }
            $this->db->getConnection()->close();

            return $data;
        } else {
            return null;
        }
    }

    public function getCustomerSegmentationTotal($segmentation)
    {
        $query = "SELECT * FROM `{$this->table}` WHERE `segmentation` = '{$segmentation}'";
        $result = $this->db->getConnection()->query($query);

        if ($result->num_rows > 0) {
            $this->db->getConnection()->close();

            return $result->num_rows;
        } else {
            return null;
        }
    }

    public function getCustomerById($id)
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

    public function searchCustomer($key)
    {
        $data = [];
        $keyFormat = "%" . $key . "%";

        $stmt = $this->db->getConnection()->prepare("SELECT * FROM {$this->table} WHERE
            customer_name LIKE ? OR
            sales_name LIKE ? OR
            segmentation LIKE ?");

        $stmt->bind_param('sss', $keyFormat, $keyFormat, $keyFormat);

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

    public function addCustomer($param = [])
    {
        $stmt = $this->db->getConnection()->prepare("INSERT INTO {$this->table} (customer_name, sales_name, segmentation)
            VALUES (?, ?, ?)");

        $stmt->bind_param(
            'sss',
            $param['customer_name'],
            $param['sales_name'],
            $param['segmentation']
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

    public function updateCustomer($id, $param = [])
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

    public function removeCustomer($id)
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
