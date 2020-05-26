<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran extends CI_Controller
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

        $config['base_url']       = base_url('admin/pengeluaran/index/');
        $config['total_rows']     = count($this->kas_model->total_row_pengeluaran());
        $config['per_page']       = 3;
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
        $limit                    = $config['per_page'];
        $start                    = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);





        $pengeluaran                = $this->kas_model->get_pengeluaran($limit, $start);
        $total_pengeluaran          = $this->kas_model->total_pengeluaran();
        $data = [
            'title'                 => 'Data Pengeluaran',
            'pengeluaran'           => $pengeluaran,
            'total_pengeluaran'     => $total_pengeluaran,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/pengeluaran/index_pengeluaran'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Filter Semua Pengeluaran
    public function filter_alpengeluaran()
    {
        // $startdate = '2020-04-26';
        // $enddate = '2020-04-25';

        // $startdate = $this->input->post('start_date');
        // $enddate = $this->input->post('end_date');


        $startdate = "";
        $enddate = "";


        if (isset($_POST['start_date'])) {
            $startdate = $_POST['start_date'];
        }

        if (isset($_POST['end_date'])) {
            $enddate = $_POST['end_date'];
        }

        $filter_alpengeluaran            = $this->kas_model->filter_alpengeluaran($startdate, $enddate);
        $total_pengeluaran_aldate        = $this->kas_model->total_pengeluaran_aldate($startdate, $enddate);



        // $total_pemasukan        = $this->kas_model->total_pemasukan();
        // $total_pengeluaran      = $this->kas_model->total_pengeluaran();

        $data = [
            'title'                     => 'Data Pengeluaran tanggal',
            'filter_pengeluaran'        => $filter_alpengeluaran,
            'total_pengeluaran_date'    => $total_pengeluaran_aldate,
            'content'                   => 'admin/pengeluaran/filter_alpengeluaran'
        ];

        $this->session->set_flashdata('messagefilter',  'Menampilkan Data dari Tanggal ' . date("d/m/Y", strtotime($startdate)) . ' Sampai Tanggal ' . date("d/m/Y", strtotime($enddate)));
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Filter Pengeluaran By cabang
    public function filter_pengeluaran()
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

        $filter_pengeluaran            = $this->kas_model->filter_pengeluaran($startdate, $enddate, $asrama);
        $total_pengeluaran_date        = $this->kas_model->total_pengeluaran_date($startdate, $enddate, $asrama);



        // $total_pemasukan        = $this->kas_model->total_pemasukan();
        // $total_pengeluaran      = $this->kas_model->total_pengeluaran();

        $data = [
            'title'                     => 'Data Pengeluaran tanggal',
            'listasrama'                => $listasrama,
            'filter_pengeluaran'        => $filter_pengeluaran,
            'total_pengeluaran_date'    => $total_pengeluaran_date,
            'content'                   => 'admin/pengeluaran/filter_pengeluaran'
        ];

        $this->session->set_flashdata('messagefilter',  'Menampilkan Data dari Tanggal ' . date("d/m/Y", strtotime($startdate)) . ' Sampai Tanggal ' . date("d/m/Y", strtotime($enddate)));
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //Buat Data Pengeluaran
    public function create()
    {

        $category = $this->category_model->get_category_pengeluaran();
        $this->form_validation->set_rules(
            'tanggal',
            'Tanggal',
            'required',
            [
                'required'      => 'Tanggal harus Di Isi',
            ]
        );
        $this->form_validation->set_rules(
            'category_id',
            'Kategori',
            'required',
            [
                'required'      => 'Harus Pilih Kategori',
            ]
        );
        $this->form_validation->set_rules(
            'pengeluaran',
            'Nominal',
            'required',
            [
                'required'      => 'Nominal Harus di isi',
            ]
        );
        $this->form_validation->set_rules(
            'keterangan',
            'Keterangan',
            'required',
            [
                'required'      => 'Keterangan Harus di isi',
            ]
        );
        if ($this->form_validation->run()) {

            if (!empty($_FILES['foto']['name'])) {

                $config['upload_path']          = './assets/img/donatur/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000; //Dalam Kilobyte
                $config['max_width']            = 5000; //Lebar (pixel)
                $config['max_height']           = 5000; //tinggi (pixel)
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto')) {

                    //End Validasi
                    $data = [
                        'title'                 => 'Tambah Data',
                        'category'              => $category,
                        'error_upload'          => $this->upload->display_errors(),
                        'content'               => 'admin/pengeluaran/create_pengeluaran'
                    ];
                    $this->load->view('admin/layout/wrapp', $data, FALSE);

                    //Masuk Database

                } else {

                    //Proses Manipulasi Gambar
                    $upload_data    = array('uploads'  => $this->upload->data());
                    //Gambar Asli disimpan di folder assets/upload/image
                    //lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/img/donatur/' . $upload_data['uploads']['file_name'];
                    //Gambar Versi Kecil dipindahkan
                    // $config['new_image']        = './assets/img/artikel/thumbs/' . $upload_data['uploads']['file_name'];
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 500;
                    $config['height']           = 500;
                    $config['thumb_marker']     = '';

                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();


                    $data  = [
                        'user_id'               => $this->session->userdata('id'),
                        'tanggal'               => $this->input->post('tanggal'),
                        'category_id'           => $this->input->post('category_id'),
                        'nominal'               => 0,
                        'pengeluaran'           => $this->input->post('pengeluaran'),
                        'foto'                  => $upload_data['uploads']['file_name'],
                        'keterangan'            => $this->input->post('keterangan'),
                        'type'                  => 'Pengeluaran',
                        'date_created'          => time()
                    ];
                    $this->kas_model->create($data);
                    $this->session->set_flashdata('message', 'Data Pengeluaran telah ditambahkan');
                    redirect(base_url('admin/pengeluaran'), 'refresh');
                }
            } else {

                $data  = [
                    'user_id'               => $this->session->userdata('id'),
                    'tanggal'               => $this->input->post('tanggal'),
                    'category_id'           => $this->input->post('category_id'),
                    'nominal'               => 0,
                    'pengeluaran'           => $this->input->post('pengeluaran'),
                    'keterangan'            => $this->input->post('keterangan'),
                    'type'                  => 'Pengeluaran',
                    'date_created'          => time()
                ];
                $this->kas_model->create($data);
                $this->session->set_flashdata('message', 'Data Pengeluaran telah di Tambahkan');
                redirect(base_url('admin/pengeluaran'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'                     => 'Tambah Pengeluaran',
            'category'                  => $category,
            'content'                   => 'admin/pengeluaran/create_pengeluaran'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Update Data Pengeluaran
    public function update($id)
    {
        $category       = $this->category_model->get_category_pengeluaran();
        $pengeluaran    = $this->kas_model->kas_detail_pengeluaran($id);

        if (!$pengeluaran) {
            redirect('admin/pengeluaran');
        }

        $this->form_validation->set_rules(
            'pengeluaran',
            'Nominal Pengeluaran',
            'required',
            [
                'required'      => 'Nominal Pengeluaran harus di isi',
            ]
        );
        if ($this->form_validation->run()) {

            if (!empty($_FILES['foto']['name'])) {

                $config['upload_path']          = './assets/img/donatur/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000; //Dalam Kilobyte
                $config['max_width']            = 5000; //Lebar (pixel)
                $config['max_height']           = 5000; //tinggi (pixel)
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto')) {

                    //End Validasi
                    $data = [
                        'title'                 => 'Update Data',
                        'category'              => $category,
                        'pengeluaran'           => $pengeluaran,
                        'error_upload'          => $this->upload->display_errors(),
                        'content'               => 'admin/pengeluaran/update_pengeluaran'
                    ];
                    $this->load->view('admin/layout/wrapp', $data, FALSE);

                    //Masuk Database

                } else {

                    //Proses Manipulasi Gambar
                    $upload_data    = array('uploads'  => $this->upload->data());
                    //Gambar Asli disimpan di folder assets/upload/image
                    //lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/img/donatur/' . $upload_data['uploads']['file_name'];
                    //Gambar Versi Kecil dipindahkan
                    // $config['new_image']        = './assets/img/artikel/thumbs/' . $upload_data['uploads']['file_name'];
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 500;
                    $config['height']           = 500;
                    $config['thumb_marker']     = '';

                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    // Hapus Gambar Lama Jika Ada upload gambar baru
                    if ($pengeluaran->foto != "") {
                        unlink('./assets/img/donatur/' . $pengeluaran->foto);
                        // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
                    }
                    //End Hapus Gambar

                    $data  = [
                        'id'                    => $id,
                        'user_id'               => $this->session->userdata('id'),
                        // 'tanggal'               => $this->input->post('tanggal'),
                        'category_id'           => $this->input->post('category_id'),
                        'nominal'               => 0,
                        'pengeluaran'           => $this->input->post('pengeluaran'),
                        'foto'                  => $upload_data['uploads']['file_name'],
                        'keterangan'            => $this->input->post('keterangan'),
                        'type'                  => 'Pengeluaran',
                        'date_updated'          => time()
                    ];
                    $this->kas_model->update($data);
                    $this->session->set_flashdata('message', 'Data Pengeluaran telah di Update');
                    redirect(base_url('admin/pengeluaran'), 'refresh');
                }
            } else {

                //Update Berita Tanpa Ganti Gambar
                if ($pengeluaran->foto != "")

                    $data  = [
                        'id'                    => $id,
                        'user_id'               => $this->session->userdata('id'),
                        // 'tanggal'               => $this->input->post('tanggal'),
                        'category_id'           => $this->input->post('category_id'),
                        'nominal'               => 0,
                        'pengeluaran'           => $this->input->post('pengeluaran'),
                        'keterangan'            => $this->input->post('keterangan'),
                        'type'                  => 'Pengeluaran',
                        'date_updated'          => time()
                    ];
                $this->kas_model->update($data);
                $this->session->set_flashdata('message', 'Data Pengeluaran telah di Update');
                redirect(base_url('admin/pengeluaran'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'                     => 'Update Pengeluaran',
            'category'                  => $category,
            'pengeluaran'               => $pengeluaran,
            'content'                   => 'admin/pengeluaran/update_pengeluaran'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    // View Detail Pemasukan
    public function view($id)
    {
        $category = $this->category_model->get_category_donasi();
        $pemasukan = $this->kas_model->kas_detail($id);

        //End Validasi
        $data = [
            'title'                 => 'Detail Data',
            'category'              => $category,
            'pemasukan'             => $pemasukan,
            'error_upload'          => $this->upload->display_errors(),
            'content'               => 'admin/pemasukan/view_pemasukan'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    // HAPUS DATA PEMASUKAN
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $pengeluaran = $this->kas_model->kas_detail_pengeluaran($id);
        //Hapus gambar

        if ($pengeluaran->foto != "") {
            unlink('./assets/img/donasi/' . $pengeluaran->foto);
            // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
        }
        //End Hapus Gambar
        $data = ['id'   => $pengeluaran->id];
        $this->kas_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
