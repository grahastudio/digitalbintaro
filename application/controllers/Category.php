<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('berita_model');
        $this->load->model('category_model');
        $this->load->model('meta_model');
    }

    public function index($category_slug)
    {
        $meta             = $this->meta_model->get_meta();
        $category_detail         = $this->berita_model->read($category_slug);
        // End Listing Berita dengan paginasi
        $data = array(
            'title'       => 'Berita - ' . $meta->title,
            'deskripsi'   => 'Berita - ' . $meta->description,
            'keywords'    => 'Berita - ' . $meta->keywords,
            'category_detail' => $category_detail,
            'content'     => 'front/category/index_category'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
}
