<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_allproduct()
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function new_product()
    {
        $this->db->select('product.*, user.user_name');
        $this->db->from('product');
        $this->db->join('user', 'user.id = product.user_id', 'LEFT');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_product($limit, $start)
    {
        $this->db->select('product.*,
                       category.category_name, user.user_name');
        $this->db->from('product');
        // Join
        $this->db->join('category', 'category.id = product.category_id', 'LEFT');
        $this->db->join('user', 'user.id = product.user_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_myproduct($id, $limit, $start)
    {
        $this->db->select('product.*,
                       category.category_name, user.user_name');
        $this->db->from('product');
        // Join
        $this->db->join('category', 'category.id = product.category_id', 'LEFT');
        $this->db->join('user', 'user.id = product.user_id', 'LEFT');
        //End Join
        $this->db->where('user_id', $id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    //Total Berita Main Page
    public function total_row()
    {
        $this->db->select('product.*,category.category_name, user.user_name');
        $this->db->from('product');
        // Join
        $this->db->join('category', 'category.id = product.category_id', 'LEFT');
        $this->db->join('user', 'user.id = product.user_id', 'LEFT');
        //End Join
        $this->db->where(['product_status'     =>  'Aktif']);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function product_detail($id)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function myproduct_detail($id)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    //Kirim Data Berita ke database
    public function create($data)
    {
        $this->db->insert('product', $data);
    }
    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('product', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('product', $data);
    }

    // Data Berita yang di tampilkan di Front End

    //listing Berita Main Page
    public function product($limit, $start)
    {
        $this->db->select('product.*,category.category_name, user.user_name');
        $this->db->from('product');
        // Join
        $this->db->join('category', 'category.id = product.category_id', 'LEFT');
        $this->db->join('user', 'user.id = product.user_id', 'LEFT');
        //End Join
        $this->db->where(['product_status'     =>  'Aktif']);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    //Total Berita Main Page
    public function total()
    {
        $this->db->select('product.*,category.category_name, user.user_name');
        $this->db->from('product');
        // Join
        $this->db->join('category', 'category.id = product.category_id', 'LEFT');
        $this->db->join('user', 'user.id = product.user_id', 'LEFT');
        //End Join
        $this->db->where(['product_status'     =>  'Aktif']);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    //Total Product Vendor
    public function total_myproduct()
    {
        $this->db->select('product.*,category.category_name, user.user_name');
        $this->db->from('product');
        // Join
        $this->db->join('category', 'category.id = product.category_id', 'LEFT');
        $this->db->join('user', 'user.id = product.user_id', 'LEFT');
        //End Join
        $this->db->where(['product_status'     =>  'Aktif']);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    //Read Berita
    public function read($product_slug)
    {
        $this->db->select('product.*,category.category_name, user.user_name, user.user_phone, user.user_image');
        $this->db->from('product');
        // Join
        $this->db->join('category', 'category.id = product.category_id', 'LEFT');
        $this->db->join('user', 'user.id = product.user_id', 'LEFT');
        //End Join
        $this->db->where(array(
            'product_status'           =>  'Aktif',
            'product.product_slug'      =>  $product_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    function update_counter($product_slug)
    {
        // return current article views
        $this->db->where('product_slug', urldecode($product_slug));
        $this->db->select('product_views');
        $count = $this->db->get('product')->row();
        // then increase by one
        $this->db->where('product_slug', urldecode($product_slug));
        $this->db->set('product_views', ($count->product_views + 1));
        $this->db->update('product');
    }


    // User Product


    //listing Product User
    public function product_user($user_id, $limit, $start)
    {
        $this->db->select('product.*,user.user_name, user.id');
        $this->db->from('product');
        // Join

        $this->db->join('user', 'user.id = product.user_id', 'LEFT');
        //End Join
        $this->db->where(array(
            'product_status'           =>  'Aktif',
            'product.user_id'      =>  $user_id
        ));
        $this->db->order_by('product.id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    //Total Produk User
    public function total_user($user_id)
    {
        $this->db->select('product.*,user.user_name, user.id');
        $this->db->from('product');
        // Join

        $this->db->join('user', 'user.id = product.user_id', 'LEFT');
        //End Join
        $this->db->where(array(
            'product_status'           =>  'Aktif',
            'product.user_id'      =>  $user_id
        ));
        $this->db->order_by('user.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listting Category Product
    public function product_category($category_id, $limit, $start)
    {
        $this->db->select('product.*,category.category_name, category.id');
        $this->db->from('product');
        // Join

        $this->db->join('category', 'category.id = product.category_id', 'LEFT');
        //End Join
        $this->db->where(array(
            'product_status'           =>  'Publish',
            'product.category_id'      =>  $category_id
        ));
        $this->db->order_by('product.id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    //Total Produk User
    public function total_category_product($category_id)
    {
        $this->db->select('product.*,category.category_name, category.id');
        $this->db->from('product');
        // Join

        $this->db->join('category', 'category.id = product.category_id', 'LEFT');
        //End Join
        $this->db->where(array(
            'product_status'                    =>  'Aktif',
            'product.category_id'               =>  $category_id
        ));
        $this->db->order_by('category.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Related Produk
    public function related_product($user_id)
    {
        $this->db->select('product.*,user.user_name, user.id');
        $this->db->from('product');
        // Join

        $this->db->join('user', 'user.id = product.user_id', 'LEFT');
        //End Join
        $this->db->where(array(
            'product_status'           =>  'Aktif',
            'product.user_id'      =>  $user_id
        ));
        $this->db->order_by('rand()');
        $this->db->limit(3);
        $query = $this->db->get();
        return $query->result();
    }
}
