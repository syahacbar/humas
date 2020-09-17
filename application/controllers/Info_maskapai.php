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
        $this->template->load('template','info_maskapai/info_maskapai_list');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Pimpinan_model->json2();
    }
    
    public function pimpinan($idpimpinan) {
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
        $this->template->load('template','info_maskapai/info_maskapai_pimpinan', $data);
    }

    
    public function tambah_keberangkatan($idpimpinan) 
    {
        $data = array(
            'button' => 'TAMBAH',
            'action' => site_url('info_maskapai/tambah_keberangkatan_action/').$idpimpinan,
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
            'action' => site_url('info_maskapai/tambah_kepulangan_action/').$idpimpinan,
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
        $this->_rules();
        $idpimpinan = $this->input->post('pimpinan_id',TRUE);
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
                'pimpinan_id' => $idpimpinan ,
            );

            $this->Info_keberangkatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('info_maskapai/pimpinan/').$this->input->post('pimpinan_id',TRUE));
        }
    }

    public function tambah_kepulangan_action() 
    {
        $this->_rules();
        $idpimpinan = $this->input->post('pimpinan_id',TRUE);
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
                'pimpinan_id' => $idpimpinan,
            );

            $this->Info_kepulangan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('info_maskapai/pimpinan/').$this->input->post('pimpinan_id',TRUE));
        }
    }

    public function update_keberangkatan($idpimpinan,$id) 
    {
        $row = $this->Info_keberangkatan_model->get_by_id($id);
        $data = array(
            'button' => 'UPDATE',
            'action' => site_url('info_maskapai/update_keberangkatan_action/').$idpimpinan,
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
            'action' => site_url('info_maskapai/update_kepulangan_action/').$idpimpinan,
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

    public function update_keberangkatan_action() 
    {
        $this->_rules();
        $idpimpinan = $this->input->post('pimpinan_id',TRUE);
        $id = $this->input->post('id',TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update_keberangkatan($idpimpinan,$id);
        } else {
            $data = array(
                'tgl_penerbangan' => $this->input->post('tgl_penerbangan',TRUE),
                'nama_maskapai' => $this->input->post('nama_maskapai',TRUE),
                'jam_berangkat' => $this->input->post('jam_berangkat',TRUE),
                'jam_datang' => $this->input->post('jam_datang',TRUE),
                'harga_tiket' => $this->input->post('harga_tiket',TRUE),
                'transit' => $this->input->post('transit',TRUE),
                'sumber' => $this->input->post('sumber',TRUE),
                'pimpinan_id' => $idpimpinan,
            );

            $this->Info_keberangkatan_model->update($id,$data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('info_maskapai/pimpinan/').$idpimpinan);
        }
    }

    public function update_kepulangan_action() 
    {
        $this->_rules();
        $idpimpinan = $this->input->post('pimpinan_id',TRUE);
        $id = $this->input->post('id',TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update_kepulangan($idpimpinan,$id);
        } else {
            $data = array(
                'tgl_penerbangan' => $this->input->post('tgl_penerbangan',TRUE),
                'nama_maskapai' => $this->input->post('nama_maskapai',TRUE),
                'jam_berangkat' => $this->input->post('jam_berangkat',TRUE),
                'jam_datang' => $this->input->post('jam_datang',TRUE),
                'harga_tiket' => $this->input->post('harga_tiket',TRUE),
                'transit' => $this->input->post('transit',TRUE),
                'sumber' => $this->input->post('sumber',TRUE),
                'pimpinan_id' => $idpimpinan,
            );

            $this->Info_kepulangan_model->update($id,$data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('info_maskapai/pimpinan/').$idpimpinan);
        }
    }
    
    public function delete_keberangkatan_action($idpimpinan,$id) 
    {
        $row = $this->Info_keberangkatan_model->get_by_id($id);

        if ($row) {
            $this->Info_keberangkatan_model->delete($id);
            $this->session->set_flashdata('message1', 'Delete Record Success');
            redirect(site_url('info_maskapai/pimpinan/').$idpimpinan);
        } else {
            $this->session->set_flashdata('message1', 'Record Not Found');
            redirect(site_url('info_maskapai/pimpinan/').$idpimpinan);
        }
    }
    
    public function delete_kepulangan_action($idpimpinan,$id) 
    {
        $row = $this->Info_kepulangan_model->get_by_id($id);

        if ($row) {
            $this->Info_kepulangan_model->delete($id);
            $this->session->set_flashdata('message2', 'Delete Record Success');
            redirect(site_url('info_maskapai/pimpinan/').$idpimpinan);
        } else {
            $this->session->set_flashdata('message2', 'Record Not Found');
            redirect(site_url('info_maskapai/pimpinan/').$idpimpinan);
        }
    }

    public function update($idpimpinan) 
    {
        $row = $this->Pimpinan_model->get_by_id($idpimpinan);

        if ($row) {
            $data = array(
                'button' => 'UPDATE DATA INFORMASI RUTE PENERBANGAN',
                'action' => site_url('info_maskapai/update_action'),
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
            redirect(site_url('info_maskapai'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'tgl_keberangkatan' => $this->input->post('tgl_keberangkatan',TRUE),
                'rute_keberangkatan' => $this->input->post('rute_keberangkatan',TRUE),
                'tgl_kepulangan' => $this->input->post('tgl_kepulangan',TRUE),
                'rute_kepulangan' => $this->input->post('rute_kepulangan',TRUE),
            );

            $this->Pimpinan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('info_maskapai'));
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

    function pdf($idpimpinan) 
    {
        $pimpinan = $this->Pimpinan_model->get_by_id($idpimpinan);
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
        $pdf->Cell(270,6,'INFORMASI MASKAPAI PENERBANGAN',0,1,'C');
        $pdf->Cell(270,6,strtoupper($pimpinan->nama),0,1,'C');
        $pdf->Cell(10,10,'',0,1);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(37,6,'Keberangkatan Tanggal: ',0,0,'L');
        $pdf->Cell(170,6,date_indo($pimpinan->tgl_keberangkatan),0,0,'L');
        $pdf->Cell(10,6,'Rute: ',0,0,'L');
        $pdf->Cell(90,6,$pimpinan->rute_keberangkatan,0,1,'L');
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(40,6,'Tgl. Penerbangan',1,0,'C');
        $pdf->Cell(40,6,'Nama Maskapai',1,0,'C');
        $pdf->Cell(40,6,'Jam Keberangkatan',1,0,'C');
        $pdf->Cell(40,6,'Jam Kedatangan',1,0,'C');
        $pdf->Cell(40,6,'Harga Tiket',1,0,'C');
        $pdf->Cell(30,6,'Transit',1,0,'C');
        $pdf->Cell(30,6,'Sumber',1,1,'C');

       $pdf->SetFont('Times', '', 10);
       
       $info_keberangkatan_data = $this->Info_keberangkatan_model->get_by_idpimpinan($idpimpinan);
        $no = 1;
        foreach ($info_keberangkatan_data as $row){
            $pdf->Cell(10,6,$no++,1,0,'C'); 
            $pdf->Cell(40,6,date_indo($row->tgl_penerbangan),1,0,'L');
            $pdf->Cell(40,6,$row->nama_maskapai,1,0,'L');
            $pdf->Cell(40,6,$row->jam_berangkat,1,0,'C');
            $pdf->Cell(40,6,$row->jam_datang,1,0,'C');
            $pdf->Cell(40,6,rupiah($row->harga_tiket),1,0,'R');
            $pdf->Cell(30,6,$row->transit,1,0,'L');
            $pdf->Cell(30,6,$row->sumber,1,1,'L');
        }

        $pdf->Cell(10,10,'',0,1);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(37,6,'Kepulangan Tanggal: ',0,0,'L');
        $pdf->Cell(170,6,date_indo($pimpinan->tgl_kepulangan),0,0,'L');
        $pdf->Cell(10,6,'Rute: ',0,0,'L');
        $pdf->Cell(90,6,$pimpinan->rute_kepulangan,0,1,'L');
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(40,6,'Tgl. Penerbangan',1,0,'C');
        $pdf->Cell(40,6,'Nama Maskapai',1,0,'C');
        $pdf->Cell(40,6,'Jam Keberangkatan',1,0,'C');
        $pdf->Cell(40,6,'Jam Kedatangan',1,0,'C');
        $pdf->Cell(40,6,'Harga Tiket',1,0,'C');
        $pdf->Cell(30,6,'Transit',1,0,'C');
        $pdf->Cell(30,6,'Sumber',1,1,'C');

       $pdf->SetFont('Times', '', 10);
       
       $info_kepulangan_data = $this->Info_kepulangan_model->get_by_idpimpinan($idpimpinan);
        $no = 1;
        foreach ($info_kepulangan_data as $row){
            $pdf->Cell(10,6,$no++,1,0,'C'); 
            $pdf->Cell(40,6,date_indo($row->tgl_penerbangan),1,0,'L');
            $pdf->Cell(40,6,$row->nama_maskapai,1,0,'L');
            $pdf->Cell(40,6,$row->jam_berangkat,1,0,'C');
            $pdf->Cell(40,6,$row->jam_datang,1,0,'C');
            $pdf->Cell(40,6,rupiah($row->harga_tiket),1,0,'R');
            $pdf->Cell(30,6,$row->transit,1,0,'L');
            $pdf->Cell(30,6,$row->sumber,1,1,'L');
        }
        $pdf->SetTitle('INFORMASI MASKAPAI PENERBANGAN '.$pimpinan->nama);
        $pdf->Output();
    }

    
}