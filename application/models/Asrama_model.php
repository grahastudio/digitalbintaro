<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asrama_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_asrama()
    {
        $this->db->select('*');
        $this->db->from('asrama');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function detail_asrama($id)
    {
        $this->db->select('*');
        $this->db->from('asrama');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //Read Berita
    public function read($id)
    {
        $this->db->select('*');
        $this->db->from('asrama');
        // Join

        //End Join
        $this->db->where(array(
            'asrama.id'      =>  $id
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('asrama', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('asrama', $data);
    }
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('asrama', $data);
    }
}
