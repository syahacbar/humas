<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Info_keberangkatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //is_login();
        $this->load->model('Info_keberangkatan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
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
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'info_keberangkatan_data' => $info_keberangkatan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','info_keberangkatan/info_keberangkatan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Info_keberangkatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'tgl_penerbangan' => $row->tgl_penerbangan,
		'nama_maskapai' => $row->nama_maskapai,
		'jam_berangkat' => $row->jam_berangkat,
		'jam_datang' => $row->jam_datang,
		'harga_tiket' => $row->harga_tiket,
		'transit' => $row->transit,
		'sumber' => $row->sumber,
		'pimpinan_id' => $row->pimpinan_id,
	    );
            $this->template->load('template','info_keberangkatan/info_keberangkatan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('info_keberangkatan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('info_keberangkatan/create_action'),
	    'id' => set_value('id'),
	    'tgl_penerbangan' => set_value('tgl_penerbangan'),
	    'nama_maskapai' => set_value('nama_maskapai'),
	    'jam_berangkat' => set_value('jam_berangkat'),
	    'jam_datang' => set_value('jam_datang'),
	    'harga_tiket' => set_value('harga_tiket'),
	    'transit' => set_value('transit'),
	    'sumber' => set_value('sumber'),
	    'pimpinan_id' => set_value('pimpinan_id'),
	);
        $this->template->load('template','info_keberangkatan/info_keberangkatan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tgl_penerbangan' => $this->input->post('tgl_penerbangan',TRUE),
		'nama_maskapai' => $this->input->post('nama_maskapai',TRUE),
		'jam_berangkat' => $this->input->post('jam_berangkat',TRUE),
		'jam_datang' => $this->input->post('jam_datang',TRUE),
		'harga_tiket' => $this->input->post('harga_tiket',TRUE),
		'transit' => $this->input->post('transit',TRUE),
		'sumber' => $this->input->post('sumber',TRUE),
		'pimpinan_id' => $this->input->post('pimpinan_id',TRUE),
	    );

            $this->Info_keberangkatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('info_keberangkatan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Info_keberangkatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('info_keberangkatan/update_action'),
		'id' => set_value('id', $row->id),
		'tgl_penerbangan' => set_value('tgl_penerbangan', $row->tgl_penerbangan),
		'nama_maskapai' => set_value('nama_maskapai', $row->nama_maskapai),
		'jam_berangkat' => set_value('jam_berangkat', $row->jam_berangkat),
		'jam_datang' => set_value('jam_datang', $row->jam_datang),
		'harga_tiket' => set_value('harga_tiket', $row->harga_tiket),
		'transit' => set_value('transit', $row->transit),
		'sumber' => set_value('sumber', $row->sumber),
		'pimpinan_id' => set_value('pimpinan_id', $row->pimpinan_id),
	    );
            $this->template->load('template','info_keberangkatan/info_keberangkatan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('info_keberangkatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'tgl_penerbangan' => $this->input->post('tgl_penerbangan',TRUE),
		'nama_maskapai' => $this->input->post('nama_maskapai',TRUE),
		'jam_berangkat' => $this->input->post('jam_berangkat',TRUE),
		'jam_datang' => $this->input->post('jam_datang',TRUE),
		'harga_tiket' => $this->input->post('harga_tiket',TRUE),
		'transit' => $this->input->post('transit',TRUE),
		'sumber' => $this->input->post('sumber',TRUE),
		'pimpinan_id' => $this->input->post('pimpinan_id',TRUE),
	    );

            $this->Info_keberangkatan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('info_keberangkatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Info_keberangkatan_model->get_by_id($id);

        if ($row) {
            $this->Info_keberangkatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('info_keberangkatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('info_keberangkatan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tgl_penerbangan', 'tgl penerbangan', 'trim|required');
	$this->form_validation->set_rules('nama_maskapai', 'nama maskapai', 'trim|required');
	$this->form_validation->set_rules('jam_berangkat', 'jam berangkat', 'trim|required');
	$this->form_validation->set_rules('jam_datang', 'jam datang', 'trim|required');
	$this->form_validation->set_rules('harga_tiket', 'harga tiket', 'trim|required|numeric');
	$this->form_validation->set_rules('transit', 'transit', 'trim|required');
	$this->form_validation->set_rules('sumber', 'sumber', 'trim|required');
	$this->form_validation->set_rules('pimpinan_id', 'pimpinan id', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Info_keberangkatan.php */
/* Location: ./application/controllers/Info_keberangkatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-09-14 13:29:46 */
/* http://harviacode.com */