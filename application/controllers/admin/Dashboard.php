<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('kas_model');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/home');
        }
    }

    public function index()
    {


        $list_user              = $this->user_model->listUser();
        $total_pemasukan        = $this->kas_model->total_pemasukan();
        $total_pengeluaran      = $this->kas_model->total_pengeluaran();
        $kas                    = $this->kas_model->get_kas_dahsboard();
        $perday                 = $this->kas_model->get_perday();
        $listasrama                 = $this->kas_model->list_asrama();
        $data = [
            'title'             => 'Dashboard',
            'list_user'         => $list_user,
            'total_pemasukan'   => $total_pemasukan,
            'total_pengeluaran' => $total_pengeluaran,
            'kas'               => $kas,
            'perday'            => $perday,
            'listasrama'        => $listasrama,
            'content'           => 'admin/dashboard/dashboard'

        ];

        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
}
