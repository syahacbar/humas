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
        $this->load->model('Pimpinan_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','agenda_kegiatan/agenda_kegiatan_pimpinan');
    } 
    function autocomplate_pimpinan(){
        autocomplate_json('pimpinan', 'nama');
    }
    
    public function json1() {
        header('Content-Type: application/json');
        echo $this->Agenda_kegiatan_model->json1();
    }

    public function pimpinan($id)
    {
        $data = array(
            'pimpinandata' => $this->Pimpinan_model->get_by_id($id),
        );
        $this->template->load('template','agenda_kegiatan/agenda_kegiatan_list',$data);
    }
    public function json2($idpimpinan) {
        header('Content-Type: application/json');
        echo $this->Agenda_kegiatan_model->json2($idpimpinan);
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

    public function create($idpimpinan) 
    {
        $data = array(
            'pimpinandata' => $this->Pimpinan_model->get_by_id($idpimpinan),
            'button' => 'TAMBAH',
            'action' => site_url('agenda_kegiatan/create_action'),
            'id' => set_value('id'),
            'tanggal' => set_value('tanggal'),
            'waktu' => set_value('waktu'),
            'tempat' => set_value('tempat'),
            'kegiatan' => set_value('kegiatan'),
            'keterangan' => set_value('keterangan'),
            'pimpinan_id' => $idpimpinan,
        );
        $this->template->load('template','agenda_kegiatan/agenda_kegiatan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        $idpimpinan = $this->input->post('pimpinan_id',TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->create($idpimpinan);
        } else {
            $data = array(
                'tanggal' => $this->input->post('tanggal',TRUE),
                'waktu' => $this->input->post('waktu',TRUE),
                'tempat' => $this->input->post('tempat',TRUE),
                'kegiatan' => $this->input->post('kegiatan',TRUE),
                'keterangan' => $this->input->post('keterangan',TRUE),
                'pimpinan_id' => $this->input->post('pimpinan_id',TRUE)
            );

            $this->Agenda_kegiatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('agenda_kegiatan/pimpinan/').$idpimpinan);
        }
    }
    
    public function update($idpimpinan,$id) 
    {
        $row = $this->Agenda_kegiatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'pimpinandata' => $this->Pimpinan_model->get_by_id($idpimpinan),
                'button' => 'UPDATE',
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

    public function word($id)
    {
        $row=$this->Pimpinan_model->get_by_id($id);
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=Agenda Kegiatan ".$row->nama.".doc");

        $data = array(
            'agenda_kegiatan_data' => $this->Agenda_kegiatan_model->get_all_by_pimpinan($id),
            'start' => 0,
            'pimpinan' => $row->nama,          
            'logo_instansi' => base_url('assets/foto_profil/').$this->session->userdata('logo_instansi'),
            'nama_instansi' => $this->session->userdata('nama_instansi'),
            'alamat_instansi' => $this->session->userdata('alamat_instansi'),
            'email_instansi' => $this->session->userdata('email_instansi'),
            'notelp_instansi' => $this->session->userdata('notelp_instansi'),
            'website_instansi' => $this->session->userdata('website_instansi'),
        );
        
        $this->load->view('agenda_kegiatan/agenda_kegiatan_doc',$data);
    }

    
    function pdf($id) 
    {
        $x=$this->Pimpinan_model->get_by_id($id);
        $this->load->library('pdf');
        $pdf = new FPDF('l', 'mm', 'A4');
        // membuat halaman baru
        $pdf->AddPage();
        $pdf->SetFont('Times', 'B', 13);
        $pdf->Cell(22,20,$pdf->Image(base_url('assets/foto_profil/').$this->session->userdata('logo_instansi'),10,10,20,20),0,0,'C');        
        $pdf->Cell(240,5,$this->session->userdata('nama_instansi'),0,1);
        $pdf->SetFont('Times', '', 12);   
        $pdf->Cell(22,5,'',0,0);  
        $pdf->Cell(240,5,$this->session->userdata('alamat_instansi'),0,1);
        $pdf->SetFont('Times', '', 12);   
        $pdf->Cell(22,5,'',0,0);  
        $pdf->Cell(240,5,'Telp/Fax: '.$this->session->userdata('notelp_instansi'),0,1);
        $pdf->SetFont('Times', '', 11);   
        $pdf->Cell(22,5,'',0,0);  
        $pdf->Cell(240,5,'Email: '.$this->session->userdata('email_instansi').' Website: '.$this->session->userdata('website_instansi'),0,1);
        $pdf->Cell(22,3,'','B',0);  
        $pdf->Cell(240,3,'','B',1);


        $pdf->Cell(10,5,'',0,1);
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Times', 'B', 11);
        // mencetak string 
        $pdf->Cell(270,6,'AGENDA KEGIATAN PIMPINAN',0,1,'C');
        $pdf->Cell(270,6,strtoupper($x->nama),0,1,'C');
        $pdf->Cell(10,10,'',0,1);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(60,6,'Hari, Tanggal',1,0,'C');
        $pdf->Cell(50,6,'Waktu',1,0,'C');
        $pdf->Cell(50,6,'Tempat',1,0,'C');
        $pdf->Cell(70,6,'Kegiatan',1,0,'C');
        $pdf->Cell(40,6,'Keterangan',1,1,'C');

       $pdf->SetFont('Times', '', 10);
       $agenda_kegiatan_data = $this->Agenda_kegiatan_model->get_all_by_pimpinan($id);
        $no = 1;
        foreach($agenda_kegiatan_data as $row) {
            $pdf->Cell(10,6,$no++,1,0,'C'); 
            $pdf->Cell(60,6,longdate_indo($row->tanggal),1,0,'L');
            $pdf->Cell(50,6,$row->waktu,1,0,'C');
            $pdf->Cell(50,6,$row->tempat,1,0,'L');
            $pdf->Cell(70,6,$row->kegiatan,1,0,'L');
            $pdf->Cell(40,6,$row->keterangan,1,1,'L');
        }
        $pdf->SetTitle('INFORMASI HOTEL '.$row->namapimpinan);
        $pdf->Output();
    }

}

/* End of file Agenda_kegiatan.php */
/* Location: ./application/controllers/Agenda_kegiatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-09-14 06:31:35 */
/* http://harviacode.com */