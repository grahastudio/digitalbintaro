<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Myaccount extends CI_Controller
{

    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('meta_model');
        $this->load->model('products_model');
        $this->load->model('category_products_model');
    }

    //main page - Berita
    public function index()
    {
        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);

        $meta = $this->meta_model->get_meta();

        // End Listing Berita dengan paginasi
        $data = array(
            'title'       => 'Akun Saya',
            'deskripsi'   => 'Berita - ' . $meta->description,
            'keywords'    => 'Berita - ' . $meta->keywords,
            'user'        => $user,
            'meta'        => $meta,
            'content'     => 'front/myaccount/index_account'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }



    public function update()
    {
        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        $meta = $this->meta_model->get_meta();

        $this->form_validation->set_rules(
            'user_name',
            'Nama',
            'required',
            [
                'required'         => 'Nama harus di isi'
            ]
        );
        if ($this->form_validation->run()) {
            //Kalau nggak Ganti gambar
            if (!empty($_FILES['user_image']['name'])) {

                $config['upload_path']          = './assets/img/avatars/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000; //Dalam Kilobyte
                $config['max_width']            = 5000; //Lebar (pixel)
                $config['max_height']           = 5000; //tinggi (pixel)
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('user_image')) {

                    //End Validasi
                    $data = [
                        'title'                 => 'Ubah Profile',
                        'meta'                  => $meta,
                        'error_upload'          => $this->upload->display_errors(),
                        'content'               => 'front/myaccount/update_account'
                    ];
                    $this->load->view('front/layout/wrapp', $data, FALSE);

                    //Masuk Database

                } else {

                    //Proses Manipulasi Gambar
                    $upload_data    = array('uploads'  => $this->upload->data());
                    //Gambar Asli disimpan di folder assets/upload/image
                    //lalu gambar Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/img/avatars/' . $upload_data['uploads']['file_name'];
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
                    if ($user->user_image != "") {
                        unlink('./assets/img/avatars/' . $user->user_image);
                        // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
                    }
                    //End Hapus Gambar

                    $data  = [
                        'id'                    => $id,
                        'user_name'             => $this->input->post('user_name'),
                        'email'                 => $this->input->post('email'),
                        'user_image'            => $upload_data['uploads']['file_name'],
                        'user_phone'            => $this->input->post('user_phone'),
                        'user_address'          => $this->input->post('user_address'),
                        'date_updated'          => time()
                    ];
                    $this->user_model->update($data);
                    $this->session->set_flashdata('message', 'Data telah di Update');
                    redirect(base_url('myaccount'), 'refresh');
                }
            } else {
                //Update Berita Tanpa Ganti Gambar
                // Hapus Gambar Lama Jika ada upload gambar baru
                if ($user->user_image != "")
                    $data  = [
                        'id'                    => $id,
                        'user_name'             => $this->input->post('user_name'),
                        'email'                 => $this->input->post('email'),
                        'user_phone'            => $this->input->post('user_phone'),
                        'user_address'          => $this->input->post('user_address'),
                        'date_updated'          => time()
                    ];
                $this->user_model->update($data);
                $this->session->set_flashdata('message', 'Data telah di Update');
                redirect(base_url('myaccount'), 'refresh');
            }
        }

        $data = [
            'title'                 => 'Ubah Profile',
            'meta'                  => $meta,
            'user'                  => $user,
            'content'               => 'front/myaccount/update_account'
        ];
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }





    public function ubah_password()
    {
        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        $meta = $this->meta_model->get_meta();

        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[3]|matches[password2]',
            [
                'required'      => 'Password harus Di isi',
                'matches'         => 'Password tidak sama',
                'min_length'     => 'Password Min 3 karakter'
            ]
        );
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            // End Listing Berita dengan paginasi
            $data = array(
                'title'       => 'Ubah Profile',
                'deskripsi'   => 'Berita - ' . $meta->description,
                'keywords'    => 'Berita - ' . $meta->keywords,
                'user'        => $user,
                'meta'        => $meta,
                'content'     => 'front/myaccount/password_account'
            );
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            $data = [
                'id'            => $id,
                'password'        => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            ];
            $this->user_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di ubah');
            redirect(base_url('myaccount'), 'refresh');
        }
    }

    // Fungsi Produk
    public function myproducts()
    {
        $config['base_url']       = base_url('myaccount/myproducts/index/');
        $config['total_rows']     = count($this->products_model->total_myproduct());
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



        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        $meta = $this->meta_model->get_meta();

        $myproducts = $this->products_model->get_myproducts($id, $limit, $start);
        $data = [
            'title'         => 'Data Produk',
            'myproducts'    => $myproducts,
            'user'          => $user,
            'meta'          => $meta,
            'pagination'    => $this->pagination->create_links(),
            'content'       => 'front/myaccount/myproducts'
        ];
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }

    //Create New products
    public function create()
    {

        $meta = $this->meta_model->get_meta();

        $category_products = $this->category_products_model->get_category_products();
        $this->form_validation->set_rules(
            'product_name',
            'Nama produk',
            'required',
            [
                'required'      => 'Nama produk harus di isi',
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
                    'category_products'     => $category_products,
                    'meta'                  => $meta,
                    'error_upload'          => $this->upload->display_errors(),
                    'content'               => 'front/myaccount/create_product'
                ];
                $this->load->view('front/layout/wrapp', $data, FALSE);

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
                    'category_product_id'   => $this->input->post('category_id'),
                    'product_slug'          => $slugcode . '-' . $product_slug,
                    'product_name'          => $this->input->post('product_name'),
                    'product_desc'          => $this->input->post('product_desc'),
                    'product_price'         => $this->input->post('product_price'),
                    'product_stock'         => $this->input->post('product_stock'),
                    'product_size'          => $this->input->post('product_size'),
                    'product_img'           => $upload_data['uploads']['file_name'],
                    'product_status'        => $this->input->post('product_status'),
                    'date_created'          => time()
                ];
                $this->products_model->create($data);
                $this->session->set_flashdata('message', 'Data Produk telah ditambahkan');
                redirect(base_url('myaccount/myproducts'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'                     => 'Tambah Produk',
            'category_products'         => $category_products,
            'content'                   => 'front/myaccount/create_product'
        ];
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }

    //Edit Berita
    public function Updateproduct($id)
    {
        // $id = $this->session->userdata('id');
        // $user = $this->user_model->user_detail($id);

        $products = $this->products_model->product_detail($id);
        //Validasi
        $category_products = $this->category_products_model->get_category_products();


        if ($products->user_id == $this->session->userdata('id')) {
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
                            'category_products'     => $category_products,
                            'products'               => $products,
                            'error_upload'          => $this->upload->display_errors(),
                            'content'               => 'front/myaccount/update_product'
                        ];
                        $this->load->view('front/layout/wrapp', $data, FALSE);

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
                        if ($products->product_img != "") {
                            unlink('./assets/img/product/' . $products->product_img);
                            // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
                        }
                        //End Hapus Gambar

                        $data  = [
                            'id'                    => $id,
                            'user_id'               => $this->session->userdata('id'),
                            'category_product_id'   => $this->input->post('category_id'),
                            'product_name'          => $this->input->post('product_name'),
                            'product_desc'          => $this->input->post('product_desc'),
                            'product_price'         => $this->input->post('product_price'),
                            'product_stock'         => $this->input->post('product_stock'),
                            'product_size'          => $this->input->post('product_size'),
                            'product_img'           => $upload_data['uploads']['file_name'],
                            'product_status'        => $this->input->post('product_status'),
                            'date_updated'          => time()
                        ];
                        $this->products_model->update($data);
                        $this->session->set_flashdata('message', 'Data telah di Update');
                        redirect(base_url('myaccount/myproducts'), 'refresh');
                    }
                } else {
                    //Update Berita Tanpa Ganti Gambar
                    // Hapus Gambar Lama Jika ada upload gambar baru
                    if ($products->product_img != "")
                        $data  = [
                            'id'                    => $id,
                            'user_id'               => $this->session->userdata('id'),
                            'category_product_id'   => $this->input->post('category_id'),
                            'product_name'          => $this->input->post('product_name'),
                            'product_desc'          => $this->input->post('product_desc'),
                            'product_price'         => $this->input->post('product_price'),
                            'product_stock'         => $this->input->post('product_stock'),
                            'product_size'          => $this->input->post('product_size'),
                            'product_status'        => $this->input->post('product_status'),
                            'date_updated'          => time()
                        ];
                    $this->products_model->update($data);
                    $this->session->set_flashdata('message', 'Data telah di Update');
                    redirect(base_url('myaccount/myproducts'), 'refresh');
                }
            }
            //End Masuk Database
            $data = [
                'title'                 => 'Update Produk',
                'category_products'     => $category_products,
                'products'              => $products,
                'content'               => 'front/myaccount/update_product'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            redirect('myaccount/myproducts');
        }
    }



    //delete
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $products = $this->products_model->myproduct_detail($id);

        if ($products->user_id == $this->session->userdata('id')) {

            //Hapus gambar

            if ($products->product_img != "") {
                unlink('./assets/img/product/' . $products->product_img);
                // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
            }
            //End Hapus Gambar
            $data = ['id'   => $products->id];
            $this->products_model->delete($data);
            $this->session->set_flashdata('message', 'Data telah di Hapus');
            redirect('myaccount/myproducts');
        } else {
            $this->session->set_flashdata('message', 'Kamu tidak Boleh menghapus data orang lain');
            redirect('myaccount/myproducts');
        }
    }
}

/* End of file berita.php */
/* Location: ./application/controllers/Berita.php */
