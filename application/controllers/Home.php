<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('meta_model');
    }
    public function index()
    {
        $meta                    = $this->meta_model->get_meta();
        $data = array(
            'title'         => $meta->title . ' - ' . $meta->tagline,
            'keywords'      => $meta->title . ' - ' . $meta->tagline . ',' . $meta->keywords,
            'deskripsi'     => $meta->description,
            'content'       => 'front/home/index_home'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
}
