
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('meta_model');
        $this->load->model('product_model');
        $this->load->model('category_model');
    }

    //main page - Berita
    public function index()
    {
        $meta           = $this->meta_model->get_meta();

        $config['base_url']       = base_url('admin/product/index/');
        $config['total_rows']     = count($this->product_model->total_row());
        $config['per_page']       = 6;
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

        $product = $this->product_model->get_product($limit, $start);
        $listcategory_product = $this->category_model->get_category_product();

        // End Listing Product dengan paginasi
        $data = array(
            'title'                 => 'Produk',
            'deskripsi'             => 'Berita - ' . $meta->description,
            'keywords'              => 'Berita - ' . $meta->keywords,
            'product'              => $product,
            'listcategory_product'     => $listcategory_product,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'front/product/index_product'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }



    // Produk - User
    public function user($id)
    {
        $user       = $this->user_model->read($id);
        $user_id    = $user->id;
        $listcategory_product = $this->category_model->get_category_product();




        $config['base_url']       = base_url('product/user/' . $id . '/index/');
        $config['total_rows']     = count($this->product_model->total_user($user_id));
        $config['per_page']       = 5;
        $config['uri_segment']    = 5;
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
        $product = $this->product_model->product_user($user_id, $limit, $start);

        // End Listing Product
        $data = array(
            'title'       => 'Product User',
            'deskripsi'   => 'Kategori Berita - ',
            'keywords'    => 'Kategori Berita - ',
            'pagination'    => $this->pagination->create_links(),
            'product'    => $product,
            'listcategory_product' => $listcategory_product,
            'user'        => $user,
            'content'     => 'front/product/user_product'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }


    // Produk - User
    public function category_product($id)
    {
        $category_product                   = $this->category_model->detail_category($id);
        $category_id                        = $category_product->id;

        $listcategory_product               = $this->category_model->get_category_product();

        // Listing Berita Dengan Pagination
        $this->load->library('pagination');

        $config['base_url']       = base_url('product/category_product/' . $id . '/index/');
        $config['total_rows']     = count($this->product_model->total_category_product($category_id));
        $config['per_page']       = 3;
        $config['uri_segment']    = 5;
        //Limit dan Start
        $limit                    = $config['per_page'];
        $start                    = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);

        $product                   = $this->product_model->product_category($category_id, $limit, $start);
        // End Listing Berita
        $data = array(
            'title'       => 'Category : ' . $category_product->category_name,
            'deskripsi'   => 'Kategori Berita - ',
            'keywords'    => 'Kategori Berita - ',
            'paginasi'    => $this->pagination->create_links(),
            'product'    => $product,
            'listcategory_product' => $listcategory_product,
            'category_product_id'        => $category_id,
            'content'     => 'front/product/index_product'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }









// Kategori - Berita
public function category($category_slug)
{
  $category       = $this->category_model->read($category_slug);
  $category_id    = $category->id;
  $listcategory_product               = $this->category_model->get_category_product();

  // Listing Berita Dengan Pagination
  $this->load->library('pagination');

  $config['base_url']       = base_url('product/category/'.$category_slug.'/index/');
  $config['total_rows']     = count($this->product_model->total_category_product($category_id));
  $config['per_page']       = 3;
  $config['uri_segment']    = 5;
  //Limit dan Start
  $limit                    = $config['per_page'];
  $start                    = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
  //End Limit Start
  $this->pagination->initialize($config);

  $product                   = $this->product_model->product_category($category_id,$limit,$start);
 
  // End Listing Berita
  $data = array(  
      'title'               => 'Kategori Berita - '.$category->category_name,
  'deskripsi'               => 'Kategori Berita - '.$category->category_name,
  'keywords'                => 'Kategori Berita - '.$category->category_name,
  'pagination'              => $this->pagination->create_links(),
  'product'                 => $product,
  'listcategory_product'    => $listcategory_product,
  'content'                 => 'front/product/index_product'
);
$this->load->view('front/layout/wrapp', $data, FALSE);
}


    //main page - detail Produk
    public function detail($product_slug = NULL)
    {
        if (!empty($product_slug)) {
            $product_slug;
        } else {
            redirect(base_url('product'));
        }

        $meta           = $this->meta_model->get_meta();
        $product         = $this->product_model->read($product_slug);
        $new_product        = $this->product_model->new_product();
    

        $data = array(
            'title'                     => 'Produk',
            'deskripsi'                 => 'Berita - ' . $meta->description,
            'keywords'                  => 'Berita - ' . $meta->keywords,
            'product'                  => $product,
            'new_product'               => $new_product,
            'content'                   => 'front/product/detail_product'
        );
        $this->add_count($product_slug);
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }

    // This is the counter function..
    function add_count($product_slug)
    {
        // load cookie helper
        $this->load->helper('cookie');
        // this line will return the cookie which has slug name
        $check_visitor = $this->input->cookie(urldecode($product_slug), FALSE);
        // this line will return the visitor ip address
        $ip = $this->input->ip_address();
        // if the visitor visit this article for first time then //
        //set new cookie and update article_views column  ..
        //you might be notice we used slug for cookie name and ip
        //address for value to distinguish between articles  views
        if ($check_visitor == false) {
            $cookie = array(
                "name"   => urldecode($product_slug),
                "value"  => "$ip",
                "expire" =>  time() + 7200,
                "secure" => false
            );
            $this->input->set_cookie($cookie);
            $this->product_model->update_counter(urldecode($product_slug));
        }
    }


// Fungsi Order Produk

public function order($id)
{
    $product = $this->product_model->product_detail($id);

    $this->form_validation->set_rules(
        'nama',
        'Nama',
        'required',
        [
          'required' 		=> 'Nama harus di isi',
        ]
      );
  
      if ($this->form_validation->run() == false) {
  
        $data = array(
            'user_id'               => $this->session->userdata('id'),
          'title'         => 'mobil',
          'deskripsi'     => 'mobil',
          'keywords'      => 'mobil',
          'product'       => $product,
          'content'       => 'front/product/order_product'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
  
      }else{
  
        $i     = $this->input;
        $data  = array(
          'kode_transaksi'    => $i->post('kode_transaksi'),
          'id_mobil'          => $i->post('id_mobil'),
          'nama_mobil'        => $i->post('nama_mobil'),
          'harga'             => $i->post('harga'),
          'nama_paket'        => $i->post('nama_paket'),
          'nama'              => $i->post('nama'),
          'email'             => $i->post('email'),
          'telp'              => $i->post('telp'),
          'jam_jemput'        => $i->post('jam_jemput'),
          'lama_sewa'         => $i->post('lama_sewa'),
          'tanggal_jemput'    => $i->post('tanggal_jemput'),
          'alamat_jemput'     => $i->post('alamat_jemput'),
          'permintaan_khusus' => $i->post('permintaan_khusus'),
          'tipe_pembayaran'   => $i->post('tipe_pembayaran'),
          'ketentuan'         => $i->post('ketentuan'),
          'status_bayar'      => 'Belum',
          'tanggal_transaksi' => date('Y-m-d H:i:s'),
          'tanggal_post'      => date('Y-m-d H:i:s')
          // 'tanggal_bayar'      => date('Y-m-d H:i:s')
  
      );
      //Proses Masuk Header Transaksi
      // $this->transaksi_model->tambah($data);
      $insert_id = $this->transaksi_model->tambah($data);

      //End Masuk tabel transaksi
    $this->session->set_flashdata('sukses', 'Checkout Berhasil');
    redirect(base_url('mobil/sukses/' .$insert_id), 'refresh');

    //End Masuk Database
    }

}



}

/* End of file berita.php */
/* Location: ./application/controllers/Berita.php */
