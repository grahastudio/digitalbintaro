<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donasi extends CI_Controller
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
            'content'       => 'front/donasi/index_donasi'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    public function detail()
    {
        $meta                    = $this->meta_model->get_meta();
        $data = array(
            'title'         => 'Konfirmasi Donasi',
            'keywords'      => $meta->title . ' - ' . $meta->tagline . ',' . $meta->keywords,
            'deskripsi'     => $meta->description,
            'content'       => 'front/donasi/detail_donasi'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    public function confirm()
    {
        $meta                    = $this->meta_model->get_meta();
        $data = array(
            'title'         => 'Konfirmasi Donasi',
            'keywords'      => $meta->title . ' - ' . $meta->tagline . ',' . $meta->keywords,
            'deskripsi'     => $meta->description,
            'content'       => 'front/donasi/confirm_donasi'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
}
