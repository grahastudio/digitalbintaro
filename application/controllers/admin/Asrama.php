<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asrama extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('asrama_model');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/home');
        }
    }
    //Index Category
    public function index()
    {
        $asrama = $this->asrama_model->get_asrama();
        //Validasi
        $this->form_validation->set_rules(
            'asrama_name',
            'Nama Asrma',
            'required|is_unique[asrama.asrama_name]',
            array(
                'required'         => '%s Harus Diisi',
                'is_unque'         => '%s <strong>' . $this->input->post('asrama_name') .
                    '</strong>Nama Asrama Sudah Ada. Buat Nama yang lain!'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'             => 'Category',
                'asrama'          => $asrama,
                'content'           => 'admin/asrama/index_asrama'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data  = [
                'asrama_name'       => $this->input->post('asrama_name'),
                'alamat'            => $this->input->post('alamat'),
                'telp'              => $this->input->post('telp'),
                'asrama_status'     => $this->input->post('asrama_status'),
                'date_created'      => time()
            ];
            $this->asrama_model->create($data);
            $this->session->set_flashdata('message', 'Data telah Asrama telah ditambahkan');
            redirect(base_url('admin/asrama'), 'refresh');
        }
    }
    //Update
    public function update($id)
    {
        $asrama = $this->asrama_model->detail_asrama($id);
        //Validasi
        $this->form_validation->set_rules(
            'asrama_name',
            'Nama Asrama',
            'required',
            array('required'         => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            //End Validasi

            $data = [
                'title'             => 'Edit Asrama',
                'asrama'          => $asrama,
                'content'           => 'admin/asrama/update_asrama'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
            //Masuk Database
        } else {

            $data  = [
                'id'                => $id,
                'asrama_name'       => $this->input->post('asrama_name'),
                'alamat'            => $this->input->post('alamat'),
                'telp'              => $this->input->post('telp'),
                'asrama_status'     => $this->input->post('asrama_status'),
                'date_updated'      => time()
            ];
            $this->asrama_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di Update');
            redirect(base_url('admin/asrama'), 'refresh');
        }
        //End Masuk Database
    }

    //delete Category
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $asrama = $this->asrama_model->detail_asrama($id);
        $data = ['id'   => $asrama->id];

        $this->asrama_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect(base_url('admin/asrama'), 'refresh');
    }
}
