<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kas_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_kas()
    {
        $this->db->select('*');
        $this->db->from('kas');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_kas_user($id)
    {
        $this->db->select('*');
        $this->db->from('kas');
        $this->db->where('user_id', $id) ;       
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Filter By Date Only
    public function searchalkas($startdate, $enddate)
    {

        $this->db->select('kas.*,
        category.category_name, user.user_name, asrama.asrama_name');
        $this->db->from('kas');
        // join
        $this->db->join('category', 'category.id = kas.category_id', 'LEFT');
        $this->db->join('user', 'user.id = kas.user_id', 'LEFT');
        $this->db->join('asrama', 'asrama.id = kas.asrama_id', 'LEFT');
        // End Join
        $this->db->where('tanggal >=', $startdate);
        $this->db->where('tanggal <=', $enddate);
        $this->db->order_by('tanggal', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // Filter By Date And User
    public function searchkas($startdate, $enddate, $asrama)
    {

        $this->db->select('kas.*,
        category.category_name, user.user_name, asrama.asrama_name');
        $this->db->from('kas');
        // join
        $this->db->join('category', 'category.id = kas.category_id', 'LEFT');
        $this->db->join('user', 'user.id = kas.user_id', 'LEFT');
        $this->db->join('asrama', 'asrama.id = kas.asrama_id', 'LEFT');
        // End Join
        $this->db->where('tanggal >=', $startdate);
        $this->db->where('tanggal <=', $enddate);
        $this->db->where('kas.asrama_id', $asrama);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // Filter Semua Pemasukan
    public function filter_alpemasukan($startdate, $enddate)
    {

        $this->db->select('kas.*,
        category.category_name, user.user_name, asrama.asrama_name');
        $this->db->from('kas');
        // JOIN
        $this->db->join('category', 'category.id = kas.category_id', 'LEFT');
        $this->db->join('user', 'user.id = kas.user_id', 'LEFT');
        $this->db->join('asrama', 'asrama.id = kas.asrama_id', 'LEFT');
        // END JOIN
        $this->db->where('tanggal >=', $startdate);
        $this->db->where('tanggal <=', $enddate);
        $this->db->where('type', 'Pemasukan');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // Filter Pemasukan By User
    public function filter_pemasukan($startdate, $enddate, $asrama)
    {

        $this->db->select('kas.*,
        category.category_name, user.user_name, asrama.asrama_name');
        $this->db->from('kas');
        // JOIN
        $this->db->join('category', 'category.id = kas.category_id', 'LEFT');
        $this->db->join('user', 'user.id = kas.user_id', 'LEFT');
        $this->db->join('asrama', 'asrama.id = kas.asrama_id', 'LEFT');

        // END JOIN
        $this->db->where('tanggal >=', $startdate);
        $this->db->where('tanggal <=', $enddate);
        $this->db->where('kas.asrama_id', $asrama);
        $this->db->where('type', 'Pemasukan');
        $this->db->order_by('kas.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // Filter Semua Pengeluaran
    public function filter_alpengeluaran($startdate, $enddate)
    {

        $this->db->select('kas.*,
        category.category_name, user.user_name, asrama.asrama_name');
        $this->db->from('kas');
        // JOIN
        $this->db->join('category', 'category.id = kas.category_id', 'LEFT');
        $this->db->join('user', 'user.id = kas.user_id', 'LEFT');
        $this->db->join('asrama', 'asrama.id = kas.asrama_id', 'LEFT');
        // END JOIN
        $this->db->where('tanggal >=', $startdate);
        $this->db->where('tanggal <=', $enddate);
        $this->db->where('type', 'Pengeluaran');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // Filter Pengeluaran By User
    public function filter_pengeluaran($startdate, $enddate, $asrama)
    {

        $this->db->select('kas.*,
        category.category_name, user.user_name, asrama.asrama_name ');
        $this->db->from('kas');
        // JOIN
        $this->db->join('category', 'category.id = kas.category_id', 'LEFT');
        $this->db->join('user', 'user.id = kas.user_id', 'LEFT');
        $this->db->join('asrama', 'asrama.id = kas.asrama_id', 'LEFT');
        // END JOIN
        $this->db->where('tanggal >=', $startdate);
        $this->db->where('tanggal <=', $enddate);
        $this->db->where('kas.asrama_id', $asrama);
        $this->db->where('type', 'Pengeluaran');
        $this->db->where('kas.asrama_id', $asrama);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_allkas($limit, $start)
    {
        $this->db->select('kas.*,asrama.asrama_name, user.user_name, category.category_name');
        $this->db->from('kas');
        // Join
        $this->db->join('asrama', 'asrama.id = kas.asrama_id', 'LEFT');
        $this->db->join('category', 'category.id = kas.category_id', 'LEFT');
        $this->db->join('user', 'user.id = kas.user_id', 'LEFT');
        //End Join
        $this->db->order_by('kas.id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_pemasukan($limit, $start)
    {
        $this->db->select('kas.*,
                       category.category_name, user.user_name, asrama.asrama_name');
        $this->db->from('kas');
        $this->db->where('type', 'Pemasukan');
        // Join
        $this->db->join('category', 'category.id = kas.category_id', 'LEFT');
        $this->db->join('asrama', 'asrama.id = kas.asrama_id', 'LEFT');
        $this->db->join('user', 'user.id = kas.user_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_pengeluaran($limit, $start)
    {
        $this->db->select('kas.*,
                       category.category_name, user.user_name, asrama.asrama_name');
        $this->db->from('kas');
        $this->db->where('type', 'Pengeluaran');
        // Join
        $this->db->join('category', 'category.id = kas.category_id', 'LEFT');
        $this->db->join('user', 'user.id = kas.user_id', 'LEFT');
        $this->db->join('asrama', 'asrama.id = kas.asrama_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_kas_dahsboard()
    {
        $this->db->select('kas.*, category.category_name');
        $this->db->from('kas');
        // Join
        $this->db->join('category', 'category.id = kas.category_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    //Total Berita Main Page
    public function total_row_kas()
    {
        $this->db->select('kas.*,category.category_name, user.user_name');
        $this->db->from('kas');
        // Join
        $this->db->join('category', 'category.id = kas.category_id', 'LEFT');
        $this->db->join('user', 'user.id = kas.user_id', 'LEFT');
        //End Join
        $this->db->order_by('kas.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    //Total Berita Main Page
    public function total_row_pemasukan()
    {
        $this->db->select('kas.*,category.category_name, user.user_name');
        $this->db->from('kas');
        // Join
        $this->db->join('category', 'category.id = kas.category_id', 'LEFT');
        $this->db->join('user', 'user.id = kas.user_id', 'LEFT');
        //End Join
        $this->db->where(['type'     =>  'Pemasukan']);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    //Total Berita Main Page
    public function total_row_pengeluaran()
    {
        $this->db->select('kas.*,category.category_name, user.user_name');
        $this->db->from('kas');
        // Join
        $this->db->join('category', 'category.id = kas.category_id', 'LEFT');
        $this->db->join('user', 'user.id = kas.user_id', 'LEFT');
        //End Join
        $this->db->where(['type'     =>  'Pengeluaran']);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function kas_detail($id)
    {
        $this->db->select('*');
        $this->db->from('kas');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function kas_detail_pengeluaran($id)
    {
        $this->db->select('*');
        $this->db->from('kas');
        $this->db->where(array('id' => $id, 'type'     =>  'Pengeluaran'));
        $query = $this->db->get();
        return $query->row();
    }
    public function kas_detail_pemasukan($id)
    {
        $this->db->select('*');
        $this->db->from('kas');
        $this->db->where(array('id' => $id, 'type'     =>  'pemasukan'));
        $query = $this->db->get();
        return $query->row();
    }
    //Kirim Data Berita ke database
    public function create($data)
    {
        $this->db->insert('kas', $data);
    }
    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('kas', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('kas', $data);
    }

    // Data Berita yang di tampilkan di Front End

    //listing Berita Main Page
    public function berita($limit, $start)
    {
        $this->db->select('berita.*,category.category_name, user.user_name');
        $this->db->from('berita');
        // Join
        $this->db->join('category', 'category.id = berita.category_id', 'LEFT');
        $this->db->join('user', 'user.id = berita.user_id', 'LEFT');
        //End Join
        $this->db->where(['berita_status'     =>  'Publish']);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    //Total Berita Main Page
    public function total()
    {
        $this->db->select('berita.*,category.category_name, user.user_name');
        $this->db->from('berita');
        // Join
        $this->db->join('category', 'category.id = berita.category_id', 'LEFT');
        $this->db->join('user', 'user.id = berita.user_id', 'LEFT');
        //End Join
        $this->db->where(['berita_status'     =>  'Publish']);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    //Read Berita
    public function read($berita_slug)
    {
        $this->db->select('berita.*,category.category_name, user.user_name');
        $this->db->from('berita');
        // Join
        $this->db->join('category', 'category.id = berita.category_id', 'LEFT');
        $this->db->join('user', 'user.id = berita.user_id', 'LEFT');
        //End Join
        $this->db->where(array(
            'berita_status'           =>  'Publish',
            'berita.berita_slug'      =>  $berita_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }



    // GET DATA AUTOCOMPLETE
    function search_blog($title)
    {
        $this->db->like('donatur_name', $title, 'both');
        $this->db->order_by('id', 'ASC');
        $this->db->limit(10);
        return $this->db->get('kas')->result();
    }

    // PENJUMLAHAN
    //Total Semua Kas Masuk
    public function total_pemasukan()
    {
        $this->db->select_sum('nominal');
        $query = $this->db->get('kas');
        if ($query->num_rows() > 0) {
            return $query->row()->nominal;
        } else {
            return 0;
        }
    }
    public function total_pemasukan_user($id)
    {
        $this->db->select_sum('nominal');
        $this->db->where(['user_id' => $id, 'type' => 'Pemasukan']);
        $query = $this->db->get('kas');
        if ($query->num_rows() > 0) {
            return $query->row()->nominal;
        } else {
            return 0;
        }
    }
    public function total_pengeluaran_user($id)
    {
        $this->db->select_sum('pengeluaran');
        $this->db->where(['user_id' => $id, 'type' => 'pengeluaran']);
        $query = $this->db->get('kas');
        if ($query->num_rows() > 0) {
            return $query->row()->pengeluaran;
        } else {
            return 0;
        }
    }
    //Total Semua Kas Keluar
    public function total_pengeluaran()
    {
        $this->db->select_sum('pengeluaran');
        $query = $this->db->get('kas');
        if ($query->num_rows() > 0) {
            return $query->row()->pengeluaran;
        } else {
            return 0;
        }
    }


    public function total_pemasukan_aldate($startdate, $enddate)
    {
        $this->db->select_sum('nominal');
        $this->db->where('tanggal >=', $startdate);
        $this->db->where('tanggal <=', $enddate);
        $query = $this->db->get('kas');
        if ($query->num_rows() > 0) {
            return $query->row()->nominal;
        } else {
            return 0;
        }
    }
    public function total_pemasukan_date($startdate, $enddate, $asrama)
    {
        $this->db->select_sum('nominal');
        $this->db->where('tanggal >=', $startdate);
        $this->db->where('tanggal <=', $enddate);
        $this->db->where('kas.asrama_id', $asrama);
        $query = $this->db->get('kas');
        if ($query->num_rows() > 0) {
            return $query->row()->nominal;
        } else {
            return 0;
        }
    }
    //Total Semua Kas Keluar
    public function total_pengeluaran_aldate($startdate, $enddate)
    {
        $this->db->select_sum('pengeluaran');
        $this->db->where('tanggal >=', $startdate);
        $this->db->where('tanggal <=', $enddate);
        $query = $this->db->get('kas');
        if ($query->num_rows() > 0) {
            return $query->row()->pengeluaran;
        } else {
            return 0;
        }
    }
    public function total_pengeluaran_date($startdate, $enddate, $asrama)
    {
        $this->db->select_sum('pengeluaran');
        $this->db->where('tanggal >=', $startdate);
        $this->db->where('tanggal <=', $enddate);
        $this->db->where('kas.asrama_id', $asrama);
        $query = $this->db->get('kas');
        if ($query->num_rows() > 0) {
            return $query->row()->pengeluaran;
        } else {
            return 0;
        }
    }

    // GET PER DATE
    public function get_perday()
    {
        $this->db->select('*');
        $this->db->where('tanggal BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()');
        $this->db->group_by('tanggal');
        $this->db->where('type', 'Pemasukan');
        $query = $this->db->get('kas');
        return $query->result();
    }

    // PEMASUKAN BY USER
    public function get_pemasukan_user($limit, $start, $id)
    {
        $this->db->select('kas.*,
                       category.category_name');
        $this->db->from('kas');
        $this->db->where(['user_id' => $id, 'type' => 'Pemasukan']);
        // Join
        $this->db->join('category', 'category.id = kas.category_id', 'LEFT');
        $this->db->join('user', 'user.id = kas.user_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    //Total Berita Main Page
    public function total_row_pemasukan_user($id)
    {
        $this->db->select('kas.*,category.category_name, user.user_name');
        $this->db->from('kas');
        // Join
        $this->db->join('category', 'category.id = kas.category_id', 'LEFT');
        $this->db->join('user', 'user.id = kas.user_id', 'LEFT');
        //End Join
        $this->db->where(['user_id' => $id, 'type' => 'Pemasukan']);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // PENGELUARAN BY USER
    public function get_pengeluaran_user($limit, $start, $id)
    {
        $this->db->select('kas.*,
                       category.category_name, user.user_name');
        $this->db->from('kas');
        $this->db->where(['user_id' => $id, 'type' => 'Pengeluaran']);
        // Join
        $this->db->join('category', 'category.id = kas.category_id', 'LEFT');
        $this->db->join('user', 'user.id = kas.user_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    //Total Berita Main Page
    public function total_row_pengeluaran_user($id)
    {
        $this->db->select('kas.*,category.category_name, user.user_name');
        $this->db->from('kas');
        // Join
        $this->db->join('category', 'category.id = kas.category_id', 'LEFT');
        $this->db->join('user', 'user.id = kas.user_id', 'LEFT');
        //End Join
        $this->db->where(['user_id' => $id, 'type' => 'Pengeluaran']);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // List Pemasukan Asrama dashboard
    public function list_asrama()
    {
        $this->db->select_sum('pengeluaran');
        $this->db->select('kas.*,asrama.asrama_name, SUM(nominal) AS nominal, SUM(pengeluaran) AS pengeluaran');
        $this->db->from('kas');
        // Join
        $this->db->join('asrama', 'asrama.id = kas.asrama_id', 'LEFT');
        $this->db->group_by('asrama_name');
        // $this->db->where('');
        $query = $this->db->get();
        return $query->result();


        

    }
}
