<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agenda_kegiatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Agenda_kegiatan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','agenda_kegiatan/agenda_kegiatan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Agenda_kegiatan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Agenda_kegiatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'tanggal' => $row->tanggal,
		'waktu' => $row->waktu,
		'tempat' => $row->tempat,
		'kegiatan' => $row->kegiatan,
		'keterangan' => $row->keterangan,
		'pimpinan_id' => $row->pimpinan_id,
	    );
            $this->template->load('template','agenda_kegiatan/agenda_kegiatan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('agenda_kegiatan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('agenda_kegiatan/create_action'),
	    'id' => set_value('id'),
	    'tanggal' => set_value('tanggal'),
	    'waktu' => set_value('waktu'),
	    'tempat' => set_value('tempat'),
	    'kegiatan' => set_value('kegiatan'),
	    'keterangan' => set_value('keterangan'),
	    'pimpinan_id' => set_value('pimpinan_id'),
	);
        $this->template->load('template','agenda_kegiatan/agenda_kegiatan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tanggal' => $this->input->post('tanggal',TRUE),
		'waktu' => $this->input->post('waktu',TRUE),
		'tempat' => $this->input->post('tempat',TRUE),
		'kegiatan' => $this->input->post('kegiatan',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'pimpinan_id' => $this->input->post('pimpinan_id',TRUE),
	    );

            $this->Agenda_kegiatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('agenda_kegiatan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Agenda_kegiatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('agenda_kegiatan/update_action'),
		'id' => set_value('id', $row->id),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'waktu' => set_value('waktu', $row->waktu),
		'tempat' => set_value('tempat', $row->tempat),
		'kegiatan' => set_value('kegiatan', $row->kegiatan),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'pimpinan_id' => set_value('pimpinan_id', $row->pimpinan_id),
	    );
            $this->template->load('template','agenda_kegiatan/agenda_kegiatan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('agenda_kegiatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'tanggal' => $this->input->post('tanggal',TRUE),
		'waktu' => $this->input->post('waktu',TRUE),
		'tempat' => $this->input->post('tempat',TRUE),
		'kegiatan' => $this->input->post('kegiatan',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'pimpinan_id' => $this->input->post('pimpinan_id',TRUE),
	    );

            $this->Agenda_kegiatan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('agenda_kegiatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Agenda_kegiatan_model->get_by_id($id);

        if ($row) {
            $this->Agenda_kegiatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('agenda_kegiatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('agenda_kegiatan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('waktu', 'waktu', 'trim|required');
	$this->form_validation->set_rules('tempat', 'tempat', 'trim|required');
	$this->form_validation->set_rules('kegiatan', 'kegiatan', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('pimpinan_id', 'pimpinan id', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "agenda_kegiatan.xls";
        $judul = "agenda_kegiatan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Waktu");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat");
	xlsWriteLabel($tablehead, $kolomhead++, "Kegiatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Pimpinan Id");

	foreach ($this->Agenda_kegiatan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->waktu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kegiatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
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
        header("Content-Disposition: attachment;Filename=agenda_kegiatan.doc");

        $data = array(
            'agenda_kegiatan_data' => $this->Agenda_kegiatan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('agenda_kegiatan/agenda_kegiatan_doc',$data);
    }

}

/* End of file Agenda_kegiatan.php */
/* Location: ./application/controllers/Agenda_kegiatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-09-14 06:31:35 */
/* http://harviacode.com */