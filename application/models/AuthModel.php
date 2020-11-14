<?php
/*
 * Created by suraiya mim
 * at 9:14pm on 29/03/2020
 */

/**
 * @property CI_DB $db Description
 */
class AuthModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function loginAuth($email)
    {
        $this->db->from(TABLE_EMPLOYEES);
        $this->db->where('eEmail', $email);
        $this->db->where('eDeleted', 0);

        $query = $this->db->get();
        if ($query->num_rows()) {
            return $query->row();
        } else {
            return false;
        }

    }

    //getByID
    function getById($table, $where)
    {
        return $this->db->get_where($table, $where)->row();
    }

}