<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;

use Exception;

class Networking
{
    private $table;
    private $db;

    function __construct()
    {
        $this->db = new Database();
        $this->table = $_ENV['NETWORKING_TABLE'];
    }

    public function getVlanGroups()
    {
        $data = [];
        $query = "SELECT * FROM {$this->table}";
        $result = $this->db->getConnection()->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                \array_push($data, $row);
            }

            $this->db->getConnection()->close();

            return $data;
        } else {
            $this->db->getConnection()->close();

            return null;
        }
    }

    public function getVlanGroupById($id)
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

    public function searchVlanGroup($key)
    {
        $data = [];
        $keyFormat = "%" . $key . "%";

        $stmt = $this->db->getConnection()->prepare("SELECT * FROM {$this->table} WHERE
            name LIKE ? OR site LIKE ? OR slug LIKE ?");

        $stmt->bind_param('sss', $keyFormat, $keyFormat, $keyFormat);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                \array_push($data, $row);
            }
            $this->db->getConnection()->close();

            return $data;
        } else {
            $this->db->getConnection()->close();

            return null;
        }
    }

    public function addVlanGroup($param)
    {
        $stmt = $this->db->getConnection()->prepare("INSERT INTO {$this->table} (name, site, slug)
            VALUES (?, ?, ?)");

        $stmt->bind_param('sss', $param['name'], $param['site'], $param['slug']);

        $success = $stmt->execute();

        if (!$success) {
            $this->db->getConnection()->close();

            return false;
        } else {
            // create new table based on vlan group name
            $newSubVlanTableName = $param['slug'];
            $createdNewTable = $this->createVlanSubTable($newSubVlanTableName);

            if (!$createdNewTable) {
                $this->db->getConnection()->close();

                return false;
            } else {
                $this->db->getConnection()->close();

                return true;
            }
        }
    }

    public function createVlanSubTable($vlanName)
    {
        $query = "CREATE TABLE `{$vlanName}` (
            id INT(6) AUTO_INCREMENT PRIMARY KEY,
            vlan_id VARCHAR(16) NOT NULL,
            group_id INT(6) NOT NULL,
            prefixes VARCHAR(64) NOT NULL,
            tenant VARCHAR(64) NOT NULL,
            status VARCHAR(64) NOT NULL,
            role VARCHAR(64) NOT NULL,
            description VARCHAR(128) NOT NULL,
            FOREIGN KEY (group_id) REFERENCES {$this->table}(id)
        )";

        if ($this->db->getConnection()->query($query) === TRUE) {
            $this->db->getConnection()->close();
            return true;
        } else {
            $this->db->getConnection()->close();
            return false;
        }
    }

    public function searchVlanSubTableData($vlanName, $key)
    {
        $data = [];
        $keyFormat = "%" . $key . "%";

        $stmt = $this->db->getConnection()->prepare("SELECT * FROM `$vlanName` WHERE
            vlan_id LIKE ? OR prefixes LIKE ? OR tenant LIKE ? OR status LIKE ? OR role LIKE ? OR description LIKE ?");

        $stmt->bind_param('ssssss', $keyFormat, $keyFormat, $keyFormat, $keyFormat, $keyFormat, $keyFormat);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                \array_push($data, $row);
            }
            $this->db->getConnection()->close();

            return $data;
        } else {
            $this->db->getConnection()->close();

            return null;
        }
    }

    public function dropVlanSubTable($vlanName)
    {
        $query = "DROP TABLE `$vlanName`";

        if ($this->db->getConnection()->query($query) === TRUE) {
            $this->db->getConnection()->close();
            return true;
        } else {
            $this->db->getConnection()->close();
            return false;
        }
    }

    public function renameSubVlanTable($from, $to)
    {
        $query = "RENAME TABLE `$from` TO `$to`";

        if ($this->db->getConnection()->query($query) === TRUE) {
            $this->db->getConnection()->close();

            return true;
        } else {
            $this->db->getConnection()->close();

            return false;
        }
    }

    public function updateVlanGroup($id, $param = [])
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

    public function removeVlanGroup($id)
    {
        // get name first for remove sub vlan table name
        $subVlan = $this->getVlanGroupById($id);

        $stmt = $this->db->getConnection()->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->bind_param('i', $id);

        $success = $stmt->execute();

        if (!$success) {
            $this->db->getConnection()->close();

            return false;
        } else {
            $removeSubVlanTable = $this->dropVlanSubTable($subVlan['slug']);

            if (!$removeSubVlanTable) {
                $this->db->getConnection()->close();

                return false;
            } else {
                $this->db->getConnection()->close();

                return true;
            }
        }
    }

    public function removeVlanSubTableData($vlanName, $id)
    {
        $stmt = $this->db->getConnection()->prepare("DELETE FROM `$vlanName` WHERE id = ?");
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

    public function getVlanSubTableData($vlanName)
    {
        $data = [];
        $query = "SELECT * FROM `$vlanName` ORDER BY convert(`vlan_id`, decimal) ASC";
        $result = $this->db->getConnection()->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                \array_push($data, $row);
            }

            $this->db->getConnection()->close();

            return $data;
        } else {
            $this->db->getConnection()->close();

            return null;
        }
    }

    public function updateVlanSubTableData($id, $vlanName, $param = [])
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

        $stmt = $this->db->getConnection()->prepare("UPDATE {$vlanName}
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

    public function addVlanSubTableData($vlanName, $param = [])
    {
        $query = "INSERT INTO `$vlanName` (vlan_id, group_id, prefixes, tenant, status, role, description)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->getConnection()->prepare($query);

        $stmt->bind_param(
            'sssssss',
            $param['vlan_id'],
            $param['group_id'],
            $param['prefixes'],
            $param['tenant'],
            $param['status'],
            $param['role'],
            $param['description']
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
}
