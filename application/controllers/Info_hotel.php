<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Info_hotel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Info_hotel_model');
        $this->load->model('Pimpinan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','info_hotel/info_hotel_list');
    } 

    function autocomplate_pimpinan(){
        autocomplate_json('pimpinan', 'nama');
    }
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Info_hotel_model->json();
    }

    public function read($id) 
    {
        $row = $this->Info_hotel_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama_hotel' => $row->nama_hotel,
		'jenis_kamar' => $row->jenis_kamar,
		'tarif_kamar' => $row->tarif_kamar,
		'fasilitas_hotel' => $row->fasilitas_hotel,
		'sumber' => $row->sumber,
		'pimpinan_id' => $row->pimpinan_id,
	    );
            $this->template->load('template','info_hotel/info_hotel_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('info_hotel'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'TAMBAH',
            'action' => site_url('info_hotel/create_action'),
            'id' => set_value('id'),
            'nama_hotel' => set_value('nama_hotel'),
            'jenis_kamar' => set_value('jenis_kamar'),
            'tarif_kamar' => set_value('tarif_kamar'),
            'fasilitas_hotel' => set_value('fasilitas_hotel'),
            'sumber' => set_value('sumber'),
            'pimpinan_id' => set_value('pimpinan_id'),
        );
        $this->template->load('template','info_hotel/info_hotel_form', $data);
    }
    
    public function create_action() 
    {
        $row = $this->Pimpinan_model->get_by_nama($this->input->post('pimpinan_id',TRUE));
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_hotel' => $this->input->post('nama_hotel',TRUE),
                'jenis_kamar' => $this->input->post('jenis_kamar',TRUE),
                'tarif_kamar' => $this->input->post('tarif_kamar',TRUE),
                'fasilitas_hotel' => $this->input->post('fasilitas_hotel',TRUE),
                'sumber' => $this->input->post('sumber',TRUE),
                'pimpinan_id' => $row->id,
            );

            $this->Info_hotel_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('info_hotel'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Info_hotel_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'UPDATE',
                'action' => site_url('info_hotel/update_action'),
                'id' => set_value('id', $row->id),
                'nama_hotel' => set_value('nama_hotel', $row->nama_hotel),
                'jenis_kamar' => set_value('jenis_kamar', $row->jenis_kamar),
                'tarif_kamar' => set_value('tarif_kamar', $row->tarif_kamar),
                'fasilitas_hotel' => set_value('fasilitas_hotel', $row->fasilitas_hotel),
                'sumber' => set_value('sumber', $row->sumber),
                'pimpinan_id' => set_value('pimpinan_id', $row->namapimpinan),
            );
            $this->template->load('template','info_hotel/info_hotel_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('info_hotel'));
        }
    }
    
    public function update_action() 
    {
        $row = $this->Pimpinan_model->get_by_nama($this->input->post('pimpinan_id',TRUE));
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama_hotel' => $this->input->post('nama_hotel',TRUE),
		'jenis_kamar' => $this->input->post('jenis_kamar',TRUE),
		'tarif_kamar' => $this->input->post('tarif_kamar',TRUE),
		'fasilitas_hotel' => $this->input->post('fasilitas_hotel',TRUE),
		'sumber' => $this->input->post('sumber',TRUE),
		'pimpinan_id' => $row->id,
	    );

            $this->Info_hotel_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('info_hotel'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Info_hotel_model->get_by_id($id);

        if ($row) {
            $this->Info_hotel_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('info_hotel'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('info_hotel'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('nama_hotel', 'nama hotel', 'trim|required');
        $this->form_validation->set_rules('jenis_kamar', 'jenis kamar', 'trim|required');
        $this->form_validation->set_rules('tarif_kamar', 'tarif kamar', 'trim|required');
        $this->form_validation->set_rules('fasilitas_hotel', 'fasilitas hotel', 'trim|required');
        $this->form_validation->set_rules('sumber', 'sumber', 'trim|required');
        $this->form_validation->set_rules('pimpinan_id', 'pimpinan id', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "info_hotel.xls";
        $judul = "info_hotel";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Hotel");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kamar");
        xlsWriteLabel($tablehead, $kolomhead++, "Tarif Kamar");
        xlsWriteLabel($tablehead, $kolomhead++, "Fasilitas Hotel");
        xlsWriteLabel($tablehead, $kolomhead++, "Sumber");
        xlsWriteLabel($tablehead, $kolomhead++, "Pimpinan Id");

	foreach ($this->Info_hotel_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_hotel);
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kamar);
            xlsWriteLabel($tablebody, $kolombody++, $data->tarif_kamar);
            xlsWriteLabel($tablebody, $kolombody++, $data->fasilitas_hotel);
            xlsWriteLabel($tablebody, $kolombody++, $data->sumber);
            xlsWriteNumber($tablebody, $kolombody++, $data->pimpinan_id);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word($id)
    {
        $row=$this->Info_hotel_model->get_by_id($id);
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=Informasi Hotel ".$row->namapimpinan.".doc");
        
        $data = array(
            'info_hotel_data' => $row,
            'start' => 0, 
            'pimpinan' => $row->namapimpinan,          
            'logo_instansi' => base_url('assets/foto_profil/').$this->session->userdata('logo_instansi'),
            'nama_instansi' => $this->session->userdata('nama_instansi'),
            'alamat_instansi' => $this->session->userdata('alamat_instansi'),
            'email_instansi' => $this->session->userdata('email_instansi'),
            'notelp_instansi' => $this->session->userdata('notelp_instansi'),
            'website_instansi' => $this->session->userdata('website_instansi'),
        );
        
        $this->load->view('info_hotel/info_hotel_doc',$data);
    }

    
    function pdf($id) 
    {
        $row=$this->Info_hotel_model->get_by_id($id);
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
        $pdf->Cell(270,6,'INFORMASI HOTEL',0,1,'C');
        $pdf->Cell(270,6,strtoupper($row->namapimpinan),0,1,'C');
        $pdf->Cell(10,10,'',0,1);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(60,6,'Nama Hotel',1,0,'C');
        $pdf->Cell(50,6,'Jenis Kamar',1,0,'C');
        $pdf->Cell(50,6,'Tarif Kamar',1,0,'C');
        $pdf->Cell(70,6,'Fasilitas Hotel',1,0,'C');
        $pdf->Cell(40,6,'Sumber',1,1,'C');

       $pdf->SetFont('Times', '', 10);
       
        $no = 1;
            $pdf->Cell(10,6,$no++,1,0,'C'); 
            $pdf->Cell(60,6,$row->nama_hotel,1,0,'L');
            $pdf->Cell(50,6,$row->jenis_kamar,1,0,'C');
            $pdf->Cell(50,6,rupiah($row->tarif_kamar),1,0,'R');
            $pdf->Cell(70,6,$row->fasilitas_hotel,1,0,'C');
            $pdf->Cell(40,6,$row->sumber,1,1,'L');
        
        $pdf->SetTitle('INFORMASI HOTEL '.$row->namapimpinan);
        $pdf->Output();
    }

}

/* End of file Info_hotel.php */
/* Location: ./application/controllers/Info_hotel.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-09-14 06:48:51 */
/* http://harviacode.com */