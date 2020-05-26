<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemasukan extends CI_Controller
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

        $config['base_url']       = base_url('admin/pemasukan/index/');
        $config['total_rows']     = count($this->kas_model->total_row_pemasukan());
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
        $limit                    = $config['per_page'];
        $start                    = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);





        $pemasukan = $this->kas_model->get_pemasukan($limit, $start);
        $total_pemasukan       = $this->kas_model->total_pemasukan();
        $data = [
            'title'             => 'Data Pemasukan',
            'pemasukan'         => $pemasukan,
            'total_pemasukan'     => $total_pemasukan,
            'pagination'        => $this->pagination->create_links(),
            'content'           => 'admin/pemasukan/index_pemasukan'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Filter Semua Pemasukan
    public function filter_alpemasukan()
    {
        $startdate = "";
        $enddate = "";

        if (isset($_POST['start_date'])) {
            $startdate = $_POST['start_date'];
        }

        if (isset($_POST['end_date'])) {
            $enddate = $_POST['end_date'];
        }



        $filter_alpemasukan            = $this->kas_model->filter_alpemasukan($startdate, $enddate);
        $total_pemasukan_aldate        = $this->kas_model->total_pemasukan_aldate($startdate, $enddate);



        // $total_pemasukan        = $this->kas_model->total_pemasukan();
        // $total_pengeluaran      = $this->kas_model->total_pengeluaran();

        $data = [
            'title'                     => 'Data Pemasukan tanggal',
            'filter_alpemasukan'          => $filter_alpemasukan,
            'total_pemasukan_aldate'      => $total_pemasukan_aldate,
            'content'                   => 'admin/pemasukan/filter_alpemasukan'
        ];

        $this->session->set_flashdata('messagefilter',  'Menampilkan Data dari Tanggal ' . date("d/m/Y", strtotime($startdate)) . ' Sampai Tanggal ' . date("d/m/Y", strtotime($enddate)));
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Filter Pemasukan Per User
    public function filter_pemasukan()
    {
        // $startdate = '2020-04-26';
        // $enddate = '2020-04-25';

        // $startdate = $this->input->post('start_date');
        // $enddate = $this->input->post('end_date');

        $asrama = "";
        $startdate = "";
        $enddate = "";

        if (isset($_POST['asrama'])) {
            $asrama = $_POST['asrama'];
        }
        if (isset($_POST['start_date'])) {
            $startdate = $_POST['start_date'];
        }

        if (isset($_POST['end_date'])) {
            $enddate = $_POST['end_date'];
        }

        $listasrama                      = $this->asrama_model->get_asrama();

        $filter_pemasukan            = $this->kas_model->filter_pemasukan($startdate, $enddate, $asrama);
        $total_pemasukan_date        = $this->kas_model->total_pemasukan_date($startdate, $enddate, $asrama);



        // $total_pemasukan        = $this->kas_model->total_pemasukan();
        // $total_pengeluaran      = $this->kas_model->total_pengeluaran();

        $data = [
            'title'                     => 'Data Pemasukan tanggal',
            'filter_pemasukan'          => $filter_pemasukan,
            'listasrama'                    => $listasrama,
            'total_pemasukan_date'      => $total_pemasukan_date,
            'content'                   => 'admin/pemasukan/filter_pemasukan'
        ];

        $this->session->set_flashdata('messagefilter',  'Menampilkan Data dari Tanggal ' . date("d/m/Y", strtotime($startdate)) . ' Sampai Tanggal ' . date("d/m/Y", strtotime($enddate)));
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    //Buat Data Pemasukan
    public function create()
    {

        $category = $this->category_model->get_category_donasi();
        $this->form_validation->set_rules(
            'tanggal',
            'Tanggal',
            'required',
            [
                'required'      => 'Tanggal Donasi harus di isi',
            ]
        );
        $this->form_validation->set_rules(
            'category_id',
            'Kategori',
            'required',
            [
                'required'      => 'Harus Pilih kategori',
            ]
        );
        $this->form_validation->set_rules(
            'donatur_title',
            'Title Donatur',
            'required',
            [
                'required'      => 'Harus Pilih Title',
            ]
        );
        $this->form_validation->set_rules(
            'donatur_name',
            'Nama Donatur',
            'required',
            [
                'required'      => 'Nama Donatur Harus Diisi',
            ]
        );
        $this->form_validation->set_rules(
            'donatur_phone',
            'Nomor HP Donatur',
            'required',
            [
                'required'      => 'Nomor HP Donatur Harus Diisi',
            ]
        );
        $this->form_validation->set_rules(
            'nominal',
            'Nominal',
            'required',
            [
                'required'      => 'Nominal Harus Diisi',
            ]
        );
        $this->form_validation->set_rules(
            'keterangan',
            'Keterangan',
            'required',
            [
                'required'      => 'Keterangan Harus Diisi',
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
                        'content'               => 'admin/pemasukan/create_pemasukan'
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
                        'nama_asrama'               => $this->input->post('nama_asrama'),
                        'tanggal'               => $this->input->post('tanggal'),
                        'category_id'           => $this->input->post('category_id'),
                        'donatur_title'            => $this->input->post('donatur_title'),
                        'donatur_name'             => $this->input->post('donatur_name'),
                        'donatur_phone'            => $this->input->post('donatur_phone'),
                        'donatur_address'          => $this->input->post('donatur_address'),
                        'nominal'               => $this->input->post('nominal'),
                        'pengeluaran'           => 0,
                        'foto'                  => $upload_data['uploads']['file_name'],
                        'keterangan'            => $this->input->post('keterangan'),
                        'type'                  => 'Pemasukan',
                        'date_created'          => time()
                    ];
                    $this->kas_model->create($data);
                    $this->session->set_flashdata('message', 'Data Donasi telah ditambahkan');
                    redirect(base_url('admin/pemasukan'), 'refresh');
                }
            } else {

                $data  = [
                    'user_id'                   => $this->session->userdata('id'),
                    'nama_asrama'               => $this->input->post('nama_asrama'),
                    'tanggal'                   => $this->input->post('tanggal'),
                    'category_id'               => $this->input->post('category_id'),
                    'donatur_title'            => $this->input->post('donatur_title'),
                    'donatur_name'             => $this->input->post('donatur_phone'),
                    'donatur_phone'            => $this->input->post('product_price'),
                    'donatur_address'          => $this->input->post('donatur_address'),
                    'nominal'               => $this->input->post('nominal'),
                    'pengeluaran'           => 0,
                    'keterangan'            => $this->input->post('keterangan'),
                    'type'                  => 'Pemasukan',
                    'date_created'          => time()
                ];
                $this->kas_model->create($data);
                $this->session->set_flashdata('message', 'Data Donasi telah di Update');
                redirect(base_url('admin/pemasukan'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'                     => 'Tambah Pemasukan',
            'category'                  => $category,
            'content'                   => 'admin/pemasukan/create_pemasukan'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Update Data Pemasukan
    public function update($id)
    {

        $category = $this->category_model->get_category_donasi();
        $pemasukan = $this->kas_model->kas_detail_pemasukan($id);

        if (!$pemasukan) {
            redirect('admin/pemasukan');
        }

        $this->form_validation->set_rules(
            'donatur_title',
            'Title Donatur',
            'required',
            [
                'required'      => 'Pilih Title',
            ]
        );
        $this->form_validation->set_rules(
            'tanggal',
            'Tanggal',
            'required',
            [
                'required'      => 'Tanggal Donasi harus di isi',
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
                        'pemasukan'             => $pemasukan,
                        'error_upload'          => $this->upload->display_errors(),
                        'content'               => 'admin/pemasukan/update_pemasukan'
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
                    if ($pemasukan->foto != "") {
                        unlink('./assets/img/donatur/' . $pemasukan->foto);
                        // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
                    }
                    //End Hapus Gambar

                    $data  = [
                        'id'                    => $id,
                        'user_id'               => $this->session->userdata('id'),
                        // 'tanggal'               => $this->input->post('tanggal'),
                        'category_id'           => $this->input->post('category_id'),
                        'donatur_title'            => $this->input->post('donatur_title'),
                        'donatur_name'             => $this->input->post('donatur_name'),
                        'donatur_phone'            => $this->input->post('donatur_phone'),
                        'donatur_address'          => $this->input->post('donatur_address'),
                        'nominal'               => $this->input->post('nominal'),
                        'pengeluaran'           => 0,
                        'foto'                  => $upload_data['uploads']['file_name'],
                        'keterangan'            => $this->input->post('keterangan'),
                        'type'                  => 'Pemasukan',
                        'date_updated'          => time()
                    ];
                    $this->kas_model->update($data);
                    $this->session->set_flashdata('message', 'Data Donasi telah ditambahkan');
                    redirect(base_url('admin/pemasukan'), 'refresh');
                }
            } else {

                //Update Berita Tanpa Ganti Gambar
                if ($pemasukan->foto != "")

                    $data  = [
                        'id'                    => $id,
                        'user_id'               => $this->session->userdata('id'),
                        // 'tanggal'               => $this->input->post('tanggal'),
                        'category_id'           => $this->input->post('category_id'),
                        'donatur_title'            => $this->input->post('donatur_title'),
                        'donatur_name'             => $this->input->post('donatur_name'),
                        'donatur_phone'            => $this->input->post('donatur_phone'),
                        'donatur_address'          => $this->input->post('donatur_address'),
                        'nominal'               => $this->input->post('nominal'),
                        'pengeluaran'           => 0,
                        'keterangan'            => $this->input->post('keterangan'),
                        'type'                  => 'Pemasukan',
                        'date_updated'          => time()
                    ];
                $this->kas_model->update($data);
                $this->session->set_flashdata('message', 'Data Donasi telah di Update');
                redirect(base_url('admin/pemasukan'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'                     => 'Tambah Pemasukan',
            'category'                  => $category,
            'pemasukan'                 => $pemasukan,
            'content'                   => 'admin/pemasukan/update_pemasukan'
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

        $pemasukan = $this->kas_model->kas_detail($id);
        //Hapus gambar

        if ($pemasukan->foto != "") {
            unlink('./assets/img/donasi/' . $pemasukan->foto);
            // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
        }
        //End Hapus Gambar
        $data = ['id'   => $pemasukan->id];
        $this->kas_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect($_SERVER['HTTP_REFERER']);
    }

    // AUTOCOMPLETE
    function get_autocomplete()
    {
        if (isset($_GET['term'])) {
            $result = $this->kas_model->search_blog($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'            => $row->donatur_name,
                        'donatur_phone'    => $row->donatur_phone,
                    );
                echo json_encode($arr_result);
            }
        }
    }
}
