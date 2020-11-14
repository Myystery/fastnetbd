<?php

/**
 * @property CI_DB $db Description
 */
class SysModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //universal model start
    //getByID
    function getById($table, $where)
    {
        return $this->db->get_where($table, $where)->row();
    }


    //avalibility check
    function is_available($table, $where)
    {
        $this->db->where($where);
        $query = $this->db->get($table);
        if ($query->num_rows()) {
            return true;
        } else {
            return false;
        }
    }

    //insert
    function insertData($table, $data)
    {
        $this->db->insert($table, $data);
        $insertID = $this->db->insert_id();
        return $insertID;
    }

    //update
    function updateData($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }

    //softRemove
    function softRemoveData($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }

    //completeRemove
    function removeData($table, $where)
    {
        return $this->db->delete($table, $where);
    }

    //select2
    function getBySelect2($selectID, $field, $data, $where, $table)
    {
        $this->db->like($field, $data);
        $this->db->where($where);
        $query = $this->db->select($selectID . ',' . $field . ' as text')
            ->limit(10)
            ->get($table);
        return $query->result();
    }
    //universal model end

    /**
     *
     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $select
     * @return boolean
     */
    function getSingleData($table, $where = 0, $order = 0, $select = 0)
    {
        if ($select) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table);
        if ($where) {
            $this->db->where($where);
        }
        if ($order) {
            foreach ($order as $key => $sort) {
                $this->db->order_by($key, $sort);
            }
        }

        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows()) {
            return $query->row();
        }
        return false;
    }

    /**
     * total()
     * @param type $table
     * @param type $where
     * @param type $select
     * @return boolean
     */
    function countTotal($table, $where = null)
    {
        if ($where) {
            $this->db->where($where);
        }
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    /**
     * custom
     * @param type $query
     * @return std class
     */
    function executeCustom($query)
    {
        $quy = $this->db->query($query);
        return $quy->result();
    }

}