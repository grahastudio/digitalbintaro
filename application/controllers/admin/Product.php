<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->library('pagination');
    }
    //listing data product
    public function index()
    {
        $config['base_url']       = base_url('admin/product/index/');
        $config['total_rows']     = count($this->product_model->total_row());
        $config['per_page']       = 5;
        $config['uri_segment']    = 4;
        // $config['use_page_numbers'] = TRUE;
        // $config['page_query_string'] = true;
        // $config['query_string_segment'] = 'page';




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





        $product = $this->product_model->get_product($limit, $start);
        $data = [
            'title'         => 'Data Produk',
            'product'        => $product,
            'pagination'    => $this->pagination->create_links(),
            'content'       => 'admin/product/index_product'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //Create New product
    public function create()
    {


        $category_product = $this->category_model->get_category_product();
        $this->form_validation->set_rules(
            'product_name',
            'Nama produk',
            'required',
            [
                'required'      => 'Nama produk harus di isi',
            ]
        );
        $this->form_validation->set_rules(
            'product_price',
            'Harga produk',
            'required',
            [
                'required'      => 'Harga produk harus di isi',
            ]
        );
        $this->form_validation->set_rules(
            'product_desc',
            'Deskripsi Produk',
            'required',
            [
                'required'      => 'Deskripsi Produk harus di isi',
            ]
        );
        if ($this->form_validation->run()) {

            $config['upload_path']          = './assets/img/product/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 5000; //Dalam Kilobyte
            $config['max_width']            = 5000; //Lebar (pixel)
            $config['max_height']           = 5000; //tinggi (pixel)
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('product_img')) {

                //End Validasi
                $data = [
                    'title'                 => 'Tambah Produk',
                    'category_product'      => $category_product,
                    'error_upload'          => $this->upload->display_errors(),
                    'content'               => 'admin/product/create_product'
                ];
                $this->load->view('admin/layout/wrapp', $data, FALSE);

                //Masuk Database

            } else {

                //Proses Manipulasi Gambar
                $upload_data    = array('uploads'  => $this->upload->data());
                //Gambar Asli disimpan di folder assets/upload/image
                //lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/product/' . $upload_data['uploads']['file_name'];
                //Gambar Versi Kecil dipindahkan
                // $config['new_image']        = './assets/img/artikel/thumbs/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 500;
                $config['height']           = 500;
                $config['thumb_marker']     = '';

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $slugcode = random_string('numeric', 5);
                $product_slug  = url_title($this->input->post('product_name'), 'dash', TRUE);
                $data  = [
                    'user_id'               => $this->session->userdata('id'),
                    'category_id'           => $this->input->post('category_id'),
                    'product_slug'          => $slugcode . '-' . $product_slug,
                    'product_name'          => $this->input->post('product_name'),
                    'product_price'         => $this->input->post('product_price'),
                    'product_desc'          => $this->input->post('product_desc'),
                    'product_img'           => $upload_data['uploads']['file_name'],
                    'product_status'        => $this->input->post('product_status'),
                    'date_created'          => time()
                ];
                $this->product_model->create($data);
                $this->session->set_flashdata('message', 'Data Produk telah ditambahkan');
                redirect(base_url('admin/product'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'                     => 'Tambah Produk',
            'category_product'          => $category_product,
            'content'                   => 'admin/product/create_product'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }


    //Edit Berita
    public function Update($id)
    {
        $product = $this->product_model->product_detail($id);
        //Validasi
        $category_product = $this->category_model->get_category_product();

        //Validasi
        $valid = $this->form_validation;

        $valid->set_rules(
            'product_name',
            'Nama Produk',
            'required',
            ['required'      => '%s harus diisi']
        );


        if ($valid->run()) {
            //Kalau nggak Ganti gambar
            if (!empty($_FILES['product_img']['name'])) {

                $config['upload_path']          = './assets/img/product/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000; //Dalam Kilobyte
                $config['max_width']            = 5000; //Lebar (pixel)
                $config['max_height']           = 5000; //tinggi (pixel)
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('product_img')) {

                    //End Validasi
                    $data = [
                        'title'                 => 'Edit Produk',
                        'category_product'     => $category_product,
                        'product'               => $product,
                        'error_upload'          => $this->upload->display_errors(),
                        'content'               => 'admin/product/update_product'
                    ];
                    $this->load->view('admin/layout/wrapp', $data, FALSE);

                    //Masuk Database

                } else {

                    //Proses Manipulasi Gambar
                    $upload_data    = array('uploads'  => $this->upload->data());
                    //Gambar Asli disimpan di folder assets/upload/image
                    //lalu gambar Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/img/product/' . $upload_data['uploads']['file_name'];
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
                    if ($product->product_img != "") {
                        unlink('./assets/img/product/' . $product->product_img);
                        // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
                    }
                    //End Hapus Gambar

                    $data  = [
                        'id'                    => $id,
                        'user_id'               => $this->session->userdata('id'),
                        'category_id'           => $this->input->post('category_id'),
                        'product_name'          => $this->input->post('product_name'),
                        'product_price'         => $this->input->post('product_price'),
                        'product_desc'          => $this->input->post('product_desc'),
                        'product_img'           => $upload_data['uploads']['file_name'],
                        'product_status'        => $this->input->post('product_status'),
                        'date_updated'          => time()
                    ];
                    $this->product_model->update($data);
                    $this->session->set_flashdata('message', 'Data telah di Update');
                    redirect(base_url('admin/product'), 'refresh');
                }
            } else {
                //Update Berita Tanpa Ganti Gambar
                // Hapus Gambar Lama Jika ada upload gambar baru
                if ($product->product_img != "")
                    $data  = [
                        'id'                    => $id,
                        'user_id'               => $this->session->userdata('id'),
                        'category_id'           => $this->input->post('category_id'),
                        'product_name'          => $this->input->post('product_name'),
                        'product_price'         => $this->input->post('product_price'),
                        'product_desc'          => $this->input->post('product_desc'),
                        'product_status'        => $this->input->post('product_status'),
                        'date_updated'          => time()
                    ];
                $this->product_model->update($data);
                $this->session->set_flashdata('message', 'Data telah di Update');
                redirect(base_url('admin/product'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'                 => 'Update Produk',
            'category_product'     => $category_product,
            'product'              => $product,
            'content'               => 'admin/product/update_product'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    //delete
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $product = $this->product_model->product_detail($id);
        //Hapus gambar

        if ($product->product_img != "") {
            unlink('./assets/img/product/' . $product->product_img);
            // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
        }
        //End Hapus Gambar
        $data = ['id'   => $product->id];
        $this->product_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
