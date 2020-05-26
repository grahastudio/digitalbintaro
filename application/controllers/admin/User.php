<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/home');
        }
    }
    public function index()
    {

        $list_user = $this->user_model->get_admin();
        $data = [
            'title'                 => 'Data User',
            'list_user'           => $list_user,
            'content'               => 'admin/user/index_user'

        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //Create User

}
