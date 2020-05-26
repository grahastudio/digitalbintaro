<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cabang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('asrama_model');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/home');
        }
    }
    public function index()
    {

        $list_cabang = $this->user_model->get_cabang();
        $data = [
            'title'                 => 'Data User',
            'list_cabang'           => $list_cabang,
            'content'               => 'admin/user/index_cabang'

        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //Create User
    public function create()
    {
        $asrama = $this->asrama_model->get_asrama();
        $this->form_validation->set_rules(
            'user_name',
            'Nama',
            'required|trim',
            ['required' => 'nama harus di isi']
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[user.email]',
            [
                'required'         => 'Email Harus diisi',
                'valid_email'     => 'Email Harus Valid',
                'is_unique'        => 'Email Sudah ada, Gunakan Email lain'
            ]
        );
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[3]|matches[password2]',
            [
                'matches'         => 'Password tidak sama',
                'min_length'     => 'Password Min 3 karakter'
            ]
        );
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data = [
                'title'         => 'Register Cabang',
                'asrama'        => $asrama,
                'content'       => 'admin/user/create_cabang'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $data = [
                'asrama_id'         => $this->input->post('asrama_id'),
                'user_name'         => $this->input->post('user_name'),
                'email'             => $this->input->post('email'),
                'user_image'        => 'default.jpg',
                'user_phone'        => $this->input->post('user_phone'),
                'user_address'      => $this->input->post('user_address'),
                'password'          => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id'           => 2,
                'is_active'         => 1,
                'date_created'      => time()
            ];

            $this->db->insert('user', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success">Selamat Anda berhasil mendaftar, silahkan Aktivasi akun</div> ');
            redirect('admin/cabang');
        }
    }
    // View Cabang
    public function view($id)
    {

        $cabang = $this->user_model->read($id);
        //End Validasi
        $data = [
            'title'                 => 'User Cabang',
            'cabang'                => $cabang,
            'content'               => 'admin/user/view_cabang'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }


    //Banned User
    public function banned($id)
    {
        //Proteksi delete
        is_login();

        $data = [
            'id'            => $id,
            'is_active'     => 0,
        ];

        $this->user_model->update($data);
        $this->session->set_flashdata('message', 'User Telah di banned');
        redirect($_SERVER['HTTP_REFERER']);
    }
    // Activated Cabang
    public function activated($id)
    {
        //Proteksi delete
        is_login();

        $data = [
            'id'            => $id,
            'is_active'     => 1,
        ];

        $this->user_model->update($data);
        $this->session->set_flashdata('message', 'User Telah di Aktifkan');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
