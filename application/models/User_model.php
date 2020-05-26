<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //listing Pendaftaran
    public function listUser()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_cabang()
    {
        $this->db->select('user.*, user_role.role, asrama.asrama_name');
        $this->db->from('user');
        // join
        $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
        $this->db->join('asrama', 'asrama.id = user.asrama_id', 'LEFT');
        // End Join
        $this->db->where('role_id', 2);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function user_detail()
    {
        $this->db->select('user.*, asrama.asrama_name');
        $this->db->from('user');
        // JOIN
        $this->db->join('asrama', 'asrama.id = user.asrama_id', 'LEFT');
        // END JOIN
        $this->db->where(array(
            'user.email'    => $this->session->userdata('email')
        ));
        $query = $this->db->get();
        return $query->row();
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('user', $data);
    }

    // Dashboard

    public function user_cabang()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('role_id', 2);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Product User Read
    public function read($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }

    // GET DATA AUTOCOMPLETE
    function search_blog($title)
    {
        $this->db->like('user_name', $title, 'both');
        $this->db->order_by('id', 'ASC');
        $this->db->limit(10);
        return $this->db->get('user')->result();
    }
}
