<?php

class M_data extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function record_exists($record,$table)
    {
        $this->db->where($record);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    function null_key($match,$key,$table)
    {
        $this->db->select($key);
        $this->db->where($match);
        $this->db->where($key.'!=','');
        $query = $this->db->get($table);
        if ($query->num_rows() > 0){
            return false;
        }
        else{
            return true;
        }
    }

    function load_field_table($table){
        return $this->db->list_fields($table);
    }

    function update($match,$data,$table){
        $this->db->where($match)
            ->update($table,$data);
    }

    function insert($data,$table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function get_all_row($table){
        $this->db->select()
            ->from($table);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_row($match,$table){
        $this->db->select()
            ->from($table)
            ->where($match);
        $query = $this->db->get();
        return $query->result_array();
    }
}

