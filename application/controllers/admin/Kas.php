<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kas extends CI_Controller
{
    //load Model & Library
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kas_model');
        $this->load->model('category_model');
        $this->load->model('user_model');
        $this->load->model('asrama_model');
        $this->load->library('pagination');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/home');
        }
    }
    //listing data Pemasukan
    public function index()
    {

        $config['base_url']       = base_url('admin/kas/index/');
        $config['total_rows']     = count($this->kas_model->total_row_kas());
        $config['per_page']       = 10;
        $config['uri_segment']    = 4;

        //Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';


        //Limit dan Start
        $limit                  = $config['per_page'];
        $start                  = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);

        $kas                    = $this->kas_model->get_allkas($limit, $start);
        $total_pemasukan        = $this->kas_model->total_pemasukan();
        $total_pengeluaran        = $this->kas_model->total_pengeluaran();
        $data = [
            'title'             => 'Data Kas',
            'kas'               => $kas,
            'total_pemasukan'   => $total_pemasukan,
            'total_pengeluaran' => $total_pengeluaran,
            'pagination'        => $this->pagination->create_links(),
            'content'           => 'admin/kas/index_kas'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Filter Semua data Kas
    public function filter_alkas()
    {
        $startdate = "";
        $enddate = "";

        if (isset($_POST['start_date'])) {
            $startdate = $_POST['start_date'];
        }

        if (isset($_POST['end_date'])) {
            $enddate = $_POST['end_date'];
        }


        $searchalkas                   = $this->kas_model->searchalkas($startdate, $enddate);
        $total_pemasukan_aldate        = $this->kas_model->total_pemasukan_aldate($startdate, $enddate);
        $total_pengeluaran_aldate      = $this->kas_model->total_pengeluaran_aldate($startdate, $enddate);

        // $total_pemasukan        = $this->kas_model->total_pemasukan();
        // $total_pengeluaran      = $this->kas_model->total_pengeluaran();

        $data = [
            'title'                     => 'Data Kas Per tanggal',
            'searchalkas'                 => $searchalkas,
            'total_pemasukan_aldate'      => $total_pemasukan_aldate,
            'total_pengeluaran_aldate'    => $total_pengeluaran_aldate,
            'content'                   => 'admin/kas/filter_alkas'
        ];
        $this->session->set_flashdata('messagefilter',  'Menampilkan Data dari Tanggal ' . date("d/m/Y", strtotime($startdate)) . ' Sampai Tanggal ' . date("d/m/Y", strtotime($enddate)));
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    // Filter Kas By User
    public function filter_kas()
    {
        // $startdate = '2020-04-26';
        // $enddate = '2020-04-25';

        // $startdate = $this->input->post('start_date');
        // $enddate = $this->input->post('end_date');


        $asrama = "";
        $startdate = "";
        $enddate = "";

        if (isset($_POST['asrama_id'])) {
            $asrama = $_POST['asrama_id'];
        }

        if (isset($_POST['start_date'])) {
            $startdate = $_POST['start_date'];
        }

        if (isset($_POST['end_date'])) {
            $enddate = $_POST['end_date'];
        }

        $listasrama                      = $this->asrama_model->get_asrama();
        $searchkas                   = $this->kas_model->searchkas($startdate, $enddate, $asrama);
        $total_pemasukan_date        = $this->kas_model->total_pemasukan_date($startdate, $enddate, $asrama);
        $total_pengeluaran_date      = $this->kas_model->total_pengeluaran_date($startdate, $enddate, $asrama);

        // $total_pemasukan        = $this->kas_model->total_pemasukan();
        // $total_pengeluaran      = $this->kas_model->total_pengeluaran();

        $data = [
            'title'                     => 'Data Kas Per tanggal',
            'searchkas'                 => $searchkas,
            'listasrama'                => $listasrama,
            'total_pemasukan_date'      => $total_pemasukan_date,
            'total_pengeluaran_date'    => $total_pengeluaran_date,
            'content'                   => 'admin/kas/filter_kas'
        ];
        $this->session->set_flashdata('messagefilter',  'Menampilkan Data' . $asrama . 'dari Tanggal ' . date("d/m/Y", strtotime($startdate)) . ' Sampai Tanggal ' . date("d/m/Y", strtotime($enddate)));
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
}
