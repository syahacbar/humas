<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Info_kepulangan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //is_login();
        $this->load->model('Info_kepulangan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','info_kepulangan/info_kepulangan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Info_kepulangan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Info_kepulangan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'tlg_penerbangan' => $row->tlg_penerbangan,
		'nama_maskapai' => $row->nama_maskapai,
		'jam_berangkat' => $row->jam_berangkat,
		'jam_datang' => $row->jam_datang,
		'harga_tiket' => $row->harga_tiket,
		'transit' => $row->transit,
		'sumber' => $row->sumber,
		'pimpinan_id' => $row->pimpinan_id,
	    );
            $this->template->load('template','info_kepulangan/info_kepulangan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('info_kepulangan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('info_kepulangan/create_action'),
            'id' => set_value('id'),
            'tlg_penerbangan' => set_value('tlg_penerbangan'),
            'nama_maskapai' => set_value('nama_maskapai'),
            'jam_berangkat' => set_value('jam_berangkat'),
            'jam_datang' => set_value('jam_datang'),
            'harga_tiket' => set_value('harga_tiket'),
            'transit' => set_value('transit'),
            'sumber' => set_value('sumber'),
            'pimpinan_id' => set_value('pimpinan_id'),
	    );
        $this->template->load('template','info_kepulangan/info_kepulangan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'tlg_penerbangan' => $this->input->post('tlg_penerbangan',TRUE),
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
            redirect(site_url('info_kepulangan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Info_kepulangan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('info_kepulangan/update_action'),
		'id' => set_value('id', $row->id),
		'tlg_penerbangan' => set_value('tlg_penerbangan', $row->tlg_penerbangan),
		'nama_maskapai' => set_value('nama_maskapai', $row->nama_maskapai),
		'jam_berangkat' => set_value('jam_berangkat', $row->jam_berangkat),
		'jam_datang' => set_value('jam_datang', $row->jam_datang),
		'harga_tiket' => set_value('harga_tiket', $row->harga_tiket),
		'transit' => set_value('transit', $row->transit),
		'sumber' => set_value('sumber', $row->sumber),
		'pimpinan_id' => set_value('pimpinan_id', $row->pimpinan_id),
	    );
            $this->template->load('template','info_kepulangan/info_kepulangan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('info_kepulangan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'tlg_penerbangan' => $this->input->post('tlg_penerbangan',TRUE),
		'nama_maskapai' => $this->input->post('nama_maskapai',TRUE),
		'jam_berangkat' => $this->input->post('jam_berangkat',TRUE),
		'jam_datang' => $this->input->post('jam_datang',TRUE),
		'harga_tiket' => $this->input->post('harga_tiket',TRUE),
		'transit' => $this->input->post('transit',TRUE),
		'sumber' => $this->input->post('sumber',TRUE),
		'pimpinan_id' => $this->input->post('pimpinan_id',TRUE),
	    );

            $this->Info_kepulangan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('info_kepulangan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Info_kepulangan_model->get_by_id($id);

        if ($row) {
            $this->Info_kepulangan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('info_kepulangan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('info_kepulangan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tlg_penerbangan', 'tlg penerbangan', 'trim|required');
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

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "info_kepulangan.xls";
        $judul = "info_kepulangan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Tlg Penerbangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Maskapai");
	xlsWriteLabel($tablehead, $kolomhead++, "Jam Berangkat");
	xlsWriteLabel($tablehead, $kolomhead++, "Jam Datang");
	xlsWriteLabel($tablehead, $kolomhead++, "Harga Tiket");
	xlsWriteLabel($tablehead, $kolomhead++, "Transit");
	xlsWriteLabel($tablehead, $kolomhead++, "Sumber");
	xlsWriteLabel($tablehead, $kolomhead++, "Pimpinan Id");

	foreach ($this->Info_kepulangan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tlg_penerbangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_maskapai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jam_berangkat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jam_datang);
	    xlsWriteNumber($tablebody, $kolombody++, $data->harga_tiket);
	    xlsWriteLabel($tablebody, $kolombody++, $data->transit);
	    xlsWriteLabel($tablebody, $kolombody++, $data->sumber);
	    xlsWriteNumber($tablebody, $kolombody++, $data->pimpinan_id);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=info_kepulangan.doc");

        $data = array(
            'info_kepulangan_data' => $this->Info_kepulangan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('info_kepulangan/info_kepulangan_doc',$data);
    }

}

/* End of file Info_kepulangan.php */
/* Location: ./application/controllers/Info_kepulangan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-09-14 06:48:31 */
/* http://harviacode.com */