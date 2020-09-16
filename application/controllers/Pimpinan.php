<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pimpinan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Info_keberangkatan_model');
        $this->load->model('Info_kepulangan_model');
        $this->load->model('Pimpinan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','pimpinan/pimpinan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Pimpinan_model->json();
    }

    public function infomaskapai($idpimpinan) {
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
        $info_keberangkatan = $this->Info_keberangkatan_model->get_limit_data($config['per_page'], $start, $q,$idpimpinan);
        $info_kepulangan = $this->Info_kepulangan_model->get_limit_data($config['per_page'], $start, $q, $idpimpinan);
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
            'pimpinan' => $this->Pimpinan_model->get_by_id($idpimpinan),
        );
        $this->template->load('template','info_maskapai/info_maskapai_list', $data);
    }
    
    public function tambah_keberangkatan($idpimpinan) 
    {
        $data = array(
            'button' => 'TAMBAH',
            'action' => site_url('pimpinan/tambah_keberangkatan_action/').$idpimpinan,
            'id' => set_value('id'),
            'tgl_penerbangan' => set_value('tgl_penerbangan'),
            'nama_maskapai' => set_value('nama_maskapai'),
            'jam_berangkat' => set_value('jam_berangkat'),
            'jam_datang' => set_value('jam_datang'),
            'harga_tiket' => set_value('harga_tiket'),
            'transit' => set_value('transit'),
            'sumber' => set_value('sumber'),
            'pimpinan_id' => set_value('pimpinan_id'),
            'pimpinan' => $this->Pimpinan_model->get_by_id($idpimpinan),
        );
        $this->template->load('template','info_keberangkatan/info_keberangkatan_form', $data);
    }

    public function tambah_kepulangan($idpimpinan) 
    {
        $data = array(
            'button' => 'TAMBAH',
            'action' => site_url('pimpinan/tambah_kepulangan_action/').$idpimpinan,
            'id' => set_value('id'),
            'tgl_penerbangan' => set_value('tgl_penerbangan'),
            'nama_maskapai' => set_value('nama_maskapai'),
            'jam_berangkat' => set_value('jam_berangkat'),
            'jam_datang' => set_value('jam_datang'),
            'harga_tiket' => set_value('harga_tiket'),
            'transit' => set_value('transit'),
            'sumber' => set_value('sumber'),
            'pimpinan_id' => set_value('pimpinan_id'),
            'pimpinan' => $this->Pimpinan_model->get_by_id($idpimpinan),
        );
        $this->template->load('template','info_kepulangan/info_kepulangan_form', $data);
    }

    public function tambah_keberangkatan_action($idpimpinan) 
    {
        $this->_rules1();

        if ($this->form_validation->run() == FALSE) {
            $this->tambah_keberangkatan($idpimpinan);
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
            redirect(site_url('pimpinan/infomaskapai/').$this->input->post('pimpinan_id',TRUE));
        }
    }

    public function tambah_kepulangan_action($idpimpinan) 
    {
        $this->_rules1();

        if ($this->form_validation->run() == FALSE) {
            $this->tambah_kepulangan($idpimpinan);
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

            $this->Info_kepulangan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('pimpinan/infomaskapai/').$this->input->post('pimpinan_id',TRUE));
        }
    }

    public function update_keberangkatan($idpimpinan,$id) 
    {
        $row = $this->Info_keberangkatan_model->get_by_id($id);
        $data = array(
            'button' => 'UPDATE',
            'action' => site_url('pimpinan/update_keberangkatan_action/').$idpimpinan,
            'id' => set_value('id',$row->id),
            'tgl_penerbangan' => set_value('tgl_penerbangan',$row->tgl_penerbangan),
            'nama_maskapai' => set_value('nama_maskapai',$row->nama_maskapai),
            'jam_berangkat' => set_value('jam_berangkat',$row->jam_berangkat),
            'jam_datang' => set_value('jam_datang',$row->jam_datang),
            'harga_tiket' => set_value('harga_tiket',$row->harga_tiket),
            'transit' => set_value('transit',$row->transit),
            'sumber' => set_value('sumber',$row->sumber),
            'pimpinan_id' => set_value('pimpinan_id',$row->pimpinan_id),
            'pimpinan' => $this->Pimpinan_model->get_by_id($idpimpinan),
        );
        $this->template->load('template','info_keberangkatan/info_keberangkatan_form', $data);
    }
    public function update_kepulangan($idpimpinan,$id) 
    {
        $row = $this->Info_kepulangan_model->get_by_id($id);
        $data = array(
            'button' => 'UPDATE',
            'action' => site_url('pimpinan/update_kepulangan_action/').$idpimpinan,
            'id' => set_value('id',$row->id),
            'tgl_penerbangan' => set_value('tgl_penerbangan',$row->tgl_penerbangan),
            'nama_maskapai' => set_value('nama_maskapai',$row->nama_maskapai),
            'jam_berangkat' => set_value('jam_berangkat',$row->jam_berangkat),
            'jam_datang' => set_value('jam_datang',$row->jam_datang),
            'harga_tiket' => set_value('harga_tiket',$row->harga_tiket),
            'transit' => set_value('transit',$row->transit),
            'sumber' => set_value('sumber',$row->sumber),
            'pimpinan_id' => set_value('pimpinan_id',$row->pimpinan_id),
            'pimpinan' => $this->Pimpinan_model->get_by_id($idpimpinan),
        );
        $this->template->load('template','info_kepulangan/info_kepulangan_form', $data);
    }
    
    public function delete_keberangkatan_action($idpimpinan,$id) 
    {
        $row = $this->Info_keberangkatan_model->get_by_id($id);

        if ($row) {
            $this->Info_keberangkatan_model->delete($id);
            $this->session->set_flashdata('message1', 'Delete Record Success');
            redirect(site_url('pimpinan/infomaskapai/').$idpimpinan);
        } else {
            $this->session->set_flashdata('message1', 'Record Not Found');
            redirect(site_url('pimpinan/infomaskapai/').$idpimpinan);
        }
    }
    
    public function delete_kepulangan_action($idpimpinan,$id) 
    {
        $row = $this->Info_kepulangan_model->get_by_id($id);

        if ($row) {
            $this->Info_kepulangan_model->delete($id);
            $this->session->set_flashdata('message2', 'Delete Record Success');
            redirect(site_url('pimpinan/infomaskapai/').$idpimpinan);
        } else {
            $this->session->set_flashdata('message2', 'Record Not Found');
            redirect(site_url('pimpinan/infomaskapai/').$idpimpinan);
        }
    }

    public function read($id) 
    {
        $row = $this->Pimpinan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'nama' => $row->nama,
                'tgl_keberangkatan' => $row->tgl_keberangkatan,
                'rute_keberangkatan' => $row->rute_keberangkatan,
                'tgl_kepulangan' => $row->tgl_kepulangan,
                'rute_kepulangan' => $row->rute_kepulangan,
            );
            $this->template->load('template','pimpinan/pimpinan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pimpinan'));
        }
    }
    
    
    public function create() 
    {
        $data = array(
            'button' => 'TAMBAH',
            'action' => site_url('pimpinan/create_action'),
            'id' => set_value('id'),
            'nama' => set_value('nama'),
            'tgl_keberangkatan' => set_value('tgl_keberangkatan'),
            'rute_keberangkatan' => set_value('rute_keberangkatan'),
            'tgl_kepulangan' => set_value('tgl_kepulangan'),
            'rute_kepulangan' => set_value('rute_kepulangan'),
        );
        $this->template->load('template','pimpinan/pimpinan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama' => $this->input->post('nama',TRUE),
                'tgl_keberangkatan' => $this->input->post('tgl_keberangkatan',TRUE),
                'rute_keberangkatan' => $this->input->post('rute_keberangkatan',TRUE),
                'tgl_kepulangan' => $this->input->post('tgl_kepulangan',TRUE),
                'rute_kepulangan' => $this->input->post('rute_kepulangan',TRUE),
            );

            $this->Pimpinan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('pimpinan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pimpinan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'UPDATE',
                'action' => site_url('pimpinan/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
		'tgl_keberangkatan' => set_value('tgl_keberangkatan', $row->tgl_keberangkatan),
		'rute_keberangkatan' => set_value('rute_keberangkatan', $row->rute_keberangkatan),
		'tgl_kepulangan' => set_value('tgl_kepulangan', $row->tgl_kepulangan),
		'rute_kepulangan' => set_value('rute_kepulangan', $row->rute_kepulangan),
	    );
            $this->template->load('template','pimpinan/pimpinan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pimpinan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'tgl_keberangkatan' => $this->input->post('tgl_keberangkatan',TRUE),
		'rute_keberangkatan' => $this->input->post('rute_keberangkatan',TRUE),
		'tgl_kepulangan' => $this->input->post('tgl_kepulangan',TRUE),
		'rute_kepulangan' => $this->input->post('rute_kepulangan',TRUE),
	    );

            $this->Pimpinan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pimpinan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pimpinan_model->get_by_id($id);

        if ($row) {
            $this->Pimpinan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pimpinan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pimpinan'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('tgl_keberangkatan', 'tgl keberangkatan', 'trim|required');
        $this->form_validation->set_rules('rute_keberangkatan', 'rute keberangkatan', 'trim|required');
        $this->form_validation->set_rules('tgl_kepulangan', 'tgl kepulangan', 'trim|required');
        $this->form_validation->set_rules('rute_kepulangan', 'rute kepulangan', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules1() 
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

    public function word($idpimpinan)
    {
        $pimpinan = $this->Pimpinan_model->get_by_id($idpimpinan);
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=Informasi Maskapai Penerbangan ".$pimpinan->nama.".doc");

        $data = array(
            'pimpinan_data' => $this->Pimpinan_model->get_by_id($idpimpinan),
            'info_keberangkatan_data' => $this->Info_keberangkatan_model->get_by_idpimpinan($idpimpinan),
            'info_kepulangan_data' => $this->Info_kepulangan_model->get_by_idpimpinan($idpimpinan),
            'start' => 0,            
            'logo_instansi' => base_url('assets/foto_profil/').$this->session->userdata('logo_instansi'),
            'nama_instansi' => $this->session->userdata('nama_instansi'),
            'alamat_instansi' => $this->session->userdata('alamat_instansi'),
            'email_instansi' => $this->session->userdata('email_instansi'),
            'notelp_instansi' => $this->session->userdata('notelp_instansi'),
            'website_instansi' => $this->session->userdata('website_instansi'),
        );
        
        $this->load->view('info_maskapai/info_maskapai_doc',$data);
    }

}

/* End of file Pimpinan.php */
/* Location: ./application/controllers/Pimpinan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-09-14 07:53:15 */
/* http://harviacode.com */