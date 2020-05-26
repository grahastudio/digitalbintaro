<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/home');
        }
    }
    //Index Category
    public function index()
    {
        $category = $this->category_model->get_category();
        //Validasi
        $this->form_validation->set_rules(
            'category_name',
            'Nama Kategori',
            'required|is_unique[category.category_name]',
            array(
                'required'         => '%s Harus Diisi',
                'is_unque'         => '%s <strong>' . $this->input->post('category_name') .
                    '</strong>Nama Kategori Sudah Ada. Buat Nama yang lain!'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'             => 'Category',
                'category'          => $category,
                'content'           => 'admin/category/index_category'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $category_slug  = url_title($this->input->post('category_name'), 'dash', TRUE);
            $data  = [
                'category_slug'     => $category_slug,
                'category_name'     => $this->input->post('category_name'),
                'category_type'     => $this->input->post('category_type'),
                'date_created'      => time()
            ];
            $this->category_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('admin/category'), 'refresh');
        }
    }
    //Update
    public function update($id)
    {
        $category = $this->category_model->detail_category($id);
        //Validasi
        $this->form_validation->set_rules(
            'category_name',
            'Nama Kategori',
            'required',
            array('required'         => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            //End Validasi

            $data = [
                'title'             => 'Edit kategori Berita',
                'category'          => $category,
                'content'           => 'admin/category/update_category'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
            //Masuk Database
        } else {

            $data  = [
                'id'                => $id,
                'category_name'     => $this->input->post('category_name'),
                'category_type'     => $this->input->post('category_type'),
                'date_updated'      => time()
            ];
            $this->category_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di Update');
            redirect(base_url('admin/category'), 'refresh');
        }
        //End Masuk Database
    }
    //delete Category
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $category = $this->category_model->detail_category($id);
        $data = ['id'   => $category->id];

        $this->category_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect(base_url('admin/category'), 'refresh');
    }
}
