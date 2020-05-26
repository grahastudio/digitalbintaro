
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
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
        $meta           = $this->meta_model->get_meta();

        $config['base_url']       = base_url('admin/products/index/');
        $config['total_rows']     = count($this->products_model->total_row());
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

        $products = $this->products_model->get_products($limit, $start);
        $listcategory_products = $this->category_products_model->get_category_products();

        // End Listing Product dengan paginasi
        $data = array(
            'title'                 => 'Produk',
            'deskripsi'             => 'Berita - ' . $meta->description,
            'keywords'              => 'Berita - ' . $meta->keywords,
            'products'              => $products,
            'listcategory_products'     => $listcategory_products,
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
        $listcategory_products = $this->category_products_model->get_category_products();




        $config['base_url']       = base_url('products/user/' . $id . '/index/');
        $config['total_rows']     = count($this->products_model->total_user($user_id));
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
        $products = $this->products_model->product_user($user_id, $limit, $start);

        // End Listing Product
        $data = array(
            'title'       => 'Product User',
            'deskripsi'   => 'Kategori Berita - ',
            'keywords'    => 'Kategori Berita - ',
            'pagination'    => $this->pagination->create_links(),
            'products'    => $products,
            'listcategory_products' => $listcategory_products,
            'user'        => $user,
            'content'     => 'front/product/user_product'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }


    // Produk - User
    public function category_products($id)
    {
        $category_products              = $this->category_products_model->read($id);
        $category_product_id             = $category_products->id;
        $listcategory_products = $this->category_products_model->get_category_products();

        // Listing Berita Dengan Pagination
        $this->load->library('pagination');

        $config['base_url']       = base_url('peoducts/category_product/' . $id . '/index/');
        $config['total_rows']     = count($this->products_model->total_category_products($category_product_id));
        $config['per_page']       = 3;
        $config['uri_segment']    = 5;
        //Limit dan Start
        $limit                    = $config['per_page'];
        $start                    = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);

        $products                   = $this->products_model->product_category($category_product_id, $limit, $start);
        // End Listing Berita
        $data = array(
            'title'       => 'Category : ' . $category_products->category_product_name,
            'deskripsi'   => 'Kategori Berita - ',
            'keywords'    => 'Kategori Berita - ',
            'paginasi'    => $this->pagination->create_links(),
            'products'    => $products,
            'listcategory_products' => $listcategory_products,
            'category_product_id'        => $category_product_id,
            'content'     => 'front/product/index_product'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }



    //main page - detail Produk
    public function detail($product_slug = NULL)
    {
        if (!empty($product_slug)) {
            $product_slug;
        } else {
            redirect(base_url('products'));
        }

        $meta           = $this->meta_model->get_meta();

        $products         = $this->products_model->read($product_slug);
        $listcategory_products = $this->category_products_model->get_category_products();


        $user_id    = $products->user_id;
        $related_products = $this->products_model->related_product($user_id);


        $data = array(
            'title'                     => 'Produk',
            'deskripsi'                 => 'Berita - ' . $meta->description,
            'keywords'                  => 'Berita - ' . $meta->keywords,
            'products'                  => $products,
            'related_products'          => $related_products,
            'listcategory_products'     => $listcategory_products,
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
            $this->products_model->update_counter(urldecode($product_slug));
        }
    }
}

/* End of file berita.php */
/* Location: ./application/controllers/Berita.php */
