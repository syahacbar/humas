<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Buku_tamu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Buku_tamu_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','buku_tamu/buku_tamu_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Buku_tamu_model->json();
    }

    public function read($id) 
    {
        $row = $this->Buku_tamu_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'tanggal' => $row->tanggal,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'jabatan' => $row->jabatan,
		'tujuan' => $row->tujuan,
		'pesan_saran' => $row->pesan_saran,
	    );
            $this->template->load('template','buku_tamu/buku_tamu_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('buku_tamu'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'TAMBAH',
            'action' => site_url('buku_tamu/create_action'),
            'id' => set_value('id'),
            'tanggal' => set_value('tanggal'),
            'nama' => set_value('nama'),
            'alamat' => set_value('alamat'),
            'jabatan' => set_value('jabatan'),
            'tujuan' => set_value('tujuan'),
            'pesan_saran' => set_value('pesan_saran'),
        );
        $this->template->load('template','buku_tamu/buku_tamu_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'tanggal' => $this->input->post('tanggal',TRUE),
                'nama' => $this->input->post('nama',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                'jabatan' => $this->input->post('jabatan',TRUE),
                'tujuan' => $this->input->post('tujuan',TRUE),
                'pesan_saran' => $this->input->post('pesan_saran',TRUE),
            );

            $this->Buku_tamu_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('buku_tamu'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Buku_tamu_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'UPDATE',
                'action' => site_url('buku_tamu/update_action'),
                'id' => set_value('id', $row->id),
                'tanggal' => set_value('tanggal', $row->tanggal),
                'nama' => set_value('nama', $row->nama),
                'alamat' => set_value('alamat', $row->alamat),
                'jabatan' => set_value('jabatan', $row->jabatan),
                'tujuan' => set_value('tujuan', $row->tujuan),
                'pesan_saran' => set_value('pesan_saran', $row->pesan_saran),
            );
            $this->template->load('template','buku_tamu/buku_tamu_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('buku_tamu'));
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
                'nama' => $this->input->post('nama',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                'jabatan' => $this->input->post('jabatan',TRUE),
                'tujuan' => $this->input->post('tujuan',TRUE),
                'pesan_saran' => $this->input->post('pesan_saran',TRUE),
            );

            $this->Buku_tamu_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('buku_tamu'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Buku_tamu_model->get_by_id($id);

        if ($row) {
            $this->Buku_tamu_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('buku_tamu'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('buku_tamu'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');
        $this->form_validation->set_rules('tujuan', 'tujuan', 'trim|required');
        $this->form_validation->set_rules('pesan_saran', 'pesan saran', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "buku_tamu.xls";
        $judul = "buku_tamu";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
        xlsWriteLabel($tablehead, $kolomhead++, "Jabatan");
        xlsWriteLabel($tablehead, $kolomhead++, "Tujuan");
        xlsWriteLabel($tablehead, $kolomhead++, "Pesan Saran");

        foreach ($this->Buku_tamu_model->get_all() as $data) {
                $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
            xlsWriteLabel($tablebody, $kolombody++, $data->jabatan);
            xlsWriteLabel($tablebody, $kolombody++, $data->tujuan);
            xlsWriteLabel($tablebody, $kolombody++, $data->pesan_saran);

            $tablebody++;
                $nourut++;
        }

        xlsEOF(); 
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=BUKU TAMU.doc");

        $data = array(
            'buku_tamu_data' => $this->Buku_tamu_model->get_all(),
            'start' => 0,        
            'logo_instansi' => base_url('assets/foto_profil/').$this->session->userdata('logo_instansi'),
            'nama_instansi' => $this->session->userdata('nama_instansi'),
            'alamat_instansi' => $this->session->userdata('alamat_instansi'),
            'email_instansi' => $this->session->userdata('email_instansi'),
            'notelp_instansi' => $this->session->userdata('notelp_instansi'),
            'website_instansi' => $this->session->userdata('website_instansi'),
        );
        
        $this->load->view('buku_tamu/buku_tamu_doc',$data);
    }

    function pdf() 
    {
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
        $pdf->Cell(270,6,'BUKU TAMU',0,1,'C');
        
        $pdf->Cell(10,10,'',0,1);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(20,6,'Hari',1,0,'C');
        $pdf->Cell(30,6,'Tanggal',1,0,'C');
        $pdf->Cell(40,6,'Nama',1,0,'C');
        $pdf->Cell(40,6,'Alamat',1,0,'C');
        $pdf->Cell(30,6,'Jabatan',1,0,'C');
        $pdf->Cell(40,6,'Tujuan',1,0,'C');
        $pdf->Cell(30,6,'Pesan/Saran',1,0,'C');
        $pdf->Cell(30,6,'Paraf',1,1,'C');

       $pdf->SetFont('Times', '', 10);
       $buku_tamu_data = $this->Buku_tamu_model->get_all();
        $no = 1;
        foreach($buku_tamu_data as $row) {
            $pdf->Cell(10,6,$no++,1,0,'C'); 
            $pdf->Cell(20,6,hari_indo($row->tanggal),1,0,'C');
            $pdf->Cell(30,6,date_indo($row->tanggal),1,0,'C');
            $pdf->Cell(40,6,$row->nama,1,0,'L');
            $pdf->Cell(40,6,$row->alamat,1,0,'L');
            $pdf->Cell(30,6,$row->jabatan,1,0,'L');
            $pdf->Cell(40,6,$row->tujuan,1,0,'L');
            $pdf->Cell(30,6,$row->pesan_saran,1,0,'L');
            $pdf->Cell(30,6,"",1,1,'L');
        }
        $pdf->SetTitle('BUKU TAMU');
        $pdf->Output();
    }


}

/* End of file Buku_tamu.php */
/* Location: ./application/controllers/Buku_tamu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-09-14 06:29:36 */
/* http://harviacode.com */