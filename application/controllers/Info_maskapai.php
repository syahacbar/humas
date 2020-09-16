<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Info_maskapai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Info_keberangkatan_model');
        $this->load->model('Info_kepulangan_model');
        $this->load->model('Info_maskapai_model');
        $this->load->model('Pimpinan_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }
    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(4));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/info_keberangkatan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/info_keberangkatan/index/';
            $config['first_url'] = base_url() . 'index.php/info_keberangkatan/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Info_keberangkatan_model->total_rows($q);
        $info_keberangkatan = $this->Info_keberangkatan_model->get_limit_data($config['per_page'], $start, $q);
        $info_kepulangan = $this->Info_kepulangan_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'info_keberangkatan_data' => $info_keberangkatan,
            'info_kepulangan_data' => $info_kepulangan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'pimpinan' => '',
        );
        $this->template->load('template','info_maskapai/info_maskapai_list', $data);
    }
    

    

    
}