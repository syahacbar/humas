<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agenda_rapat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Agenda_rapat_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
        $this->load->library('zip');
		$this->load->helper('file');
    }

    public function index()
    {
        $this->template->load('template','agenda_rapat/agenda_rapat_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Agenda_rapat_model->json();
    }

    function autocomplate_pimpinan(){
        autocomplate_json('pimpinan', 'nama');
    }

    public function upload_lampiran($id)
    {
        mkdir('./upload/agenda_rapat/'.$id);
        $config['upload_path']          = './upload/agenda_rapat/'.$id;
        $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|doc|docx|txt|xls|xlsx|ppt|pptx';
        $this->load->library('upload', $config);
    }
    public function read($id) 
    {
        $row = $this->Agenda_rapat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'tgl_rapat' => $row->tgl_rapat,
		'tempat' => $row->tempat,
		'pimpinan_rapat' => $row->pimpinan_rapat,
		'waktu' => $row->waktu,
		'agenda_rapat' => $row->agenda_rapat,
		'keterangan' => $row->keterangan,
	    );
            $this->template->load('template','agenda_rapat/agenda_rapat_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('agenda_rapat'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'TAMBAH',
            'action' => site_url('agenda_rapat/create_action'),
            'id' => set_value('id'),
            'tgl_rapat' => set_value('tgl_rapat'),
            'tempat' => set_value('tempat'),
            'pimpinan_rapat' => set_value('pimpinan_rapat'),
            'waktu' => set_value('waktu'),
            'agenda_rapat' => set_value('agenda_rapat'),
            'keterangan' => set_value('keterangan'),
            'file1' => set_value('file1'),
            'file2' => set_value('file2'),
            'file3' => set_value('file3'),
            'file4' => set_value('file4'),
        );
        $this->template->load('template','agenda_rapat/agenda_rapat_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'tgl_rapat' => $this->input->post('tgl_rapat',TRUE),
                'tempat' => $this->input->post('tempat',TRUE),
                'pimpinan_rapat' => $this->input->post('pimpinan_rapat',TRUE),
                'waktu' => $this->input->post('waktu',TRUE),
                'agenda_rapat' => $this->input->post('agenda_rapat',TRUE),
                'keterangan' => $this->input->post('keterangan',TRUE),
                'file_denah_ruangan' => $_FILES["file1"]["name"],
                'file_undangan_rapat' => $_FILES["file2"]["name"],
                'file_kebutuhan_rapat' => $_FILES["file3"]["name"],
                'file_notula_rapat' => $_FILES["file4"]["name"],
            );

            $this->Agenda_rapat_model->insert($data);
            $this->upload_lampiran($this->db->insert_id());
            $this->upload->do_upload('file1');
            $this->upload->do_upload('file2');
            $this->upload->do_upload('file3');
            $this->upload->do_upload('file4');
           
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('agenda_rapat'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Agenda_rapat_model->get_by_id($id);

        if ($row) {

            $data = array(
                'button' => 'UPDATE',
                'action' => site_url('agenda_rapat/update_action'),
                'id' => set_value('id', $row->id),
                'tgl_rapat' => set_value('tgl_rapat', $row->tgl_rapat),
                'tempat' => set_value('tempat', $row->tempat),
                'pimpinan_rapat' => set_value('pimpinan_rapat', $row->pimpinan_rapat),
                'waktu' => set_value('waktu', $row->waktu),
                'agenda_rapat' => set_value('agenda_rapat', $row->agenda_rapat),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'file1' => set_value('file1', $row->file_denah_ruangan),
                'file2' => set_value('file2', $row->file_undangan_rapat),
                'file3' => set_value('file3', $row->file_kebutuhan_rapat),
                'file4' => set_value('file4', $row->file_notula_rapat),
	        );
            $this->template->load('template','agenda_rapat/agenda_rapat_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('agenda_rapat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $this->upload_lampiran($this->input->post('id', TRUE));

            if (empty($_FILES["file1"]["name"]))
            {
                $file1 = $this->input->post('file1hidden',TRUE);
            } 
            else 
            {
                $this->upload->do_upload('file1');
                $file1 = $_FILES["file1"]["name"];
            }

            if (empty($_FILES["file2"]["name"])) 
            {
                $file2 = $this->input->post('file2hidden',TRUE);
            }
            else 
            {
                $this->upload->do_upload('file2');
                $file2 = $_FILES["file2"]["name"];
            }

            if (empty($_FILES["file3"]["name"])) 
            {
                $file3 = $this->input->post('file3hidden',TRUE);
            }
            else 
            {
                $this->upload->do_upload('file3');
                $file3 = $_FILES["file3"]["name"];
            }

            if (empty($_FILES["file4"]["name"])) 
            {
                $file4 = $this->input->post('file4hidden',TRUE);
            }
            else 
            {
                $this->upload->do_upload('file4');
                $file4 = $_FILES["file4"]["name"];
            }

           

            $data = array(
                'tgl_rapat' => $this->input->post('tgl_rapat',TRUE),
                'tempat' => $this->input->post('tempat',TRUE),
                'pimpinan_rapat' => $this->input->post('pimpinan_rapat',TRUE),
                'waktu' => $this->input->post('waktu',TRUE),
                'agenda_rapat' => $this->input->post('agenda_rapat',TRUE),
                'keterangan' => $this->input->post('keterangan',TRUE),
                'file_denah_ruangan' => $file1,
                'file_undangan_rapat' => $file2,
                'file_kebutuhan_rapat' => $file3,
                'file_notula_rapat' => $file4,
            );

            $this->Agenda_rapat_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('agenda_rapat'));
        }
    }

    public function download($id){
        $row = $this->Agenda_rapat_model->get_by_id($id);
           // File name
            $filename = "Lampiran Rapat ".$row->tgl_rapat.".zip";
            // Directory path (uploads directory stored in project root)
            $path = 'upload/agenda_rapat/'.$id.'/';

            // Add directory to zip
            $this->zip->read_dir($path, FALSE);

            // Save the zip file to archivefiles directory
            $this->zip->archive(FCPATH.'/upload/agenda_rapat/'.$filename);

            // Download
            $this->zip->download($filename);
   
    }
    
    public function delete($id) 
    {
        $row = $this->Agenda_rapat_model->get_by_id($id);

        if ($row) {
            $this->Agenda_rapat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('agenda_rapat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('agenda_rapat'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tgl_rapat', 'tgl rapat', 'trim|required');
	$this->form_validation->set_rules('tempat', 'tempat', 'trim|required');
	$this->form_validation->set_rules('pimpinan_rapat', 'pimpinan rapat', 'trim|required');
	$this->form_validation->set_rules('waktu', 'waktu', 'trim|required');
	$this->form_validation->set_rules('agenda_rapat', 'agenda rapat', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "agenda_rapat.xls";
        $judul = "agenda_rapat";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Rapat");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat");
	xlsWriteLabel($tablehead, $kolomhead++, "Pimpinan Rapat");
	xlsWriteLabel($tablehead, $kolomhead++, "Waktu");
	xlsWriteLabel($tablehead, $kolomhead++, "Agenda Rapat");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

	foreach ($this->Agenda_rapat_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_rapat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pimpinan_rapat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->waktu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->agenda_rapat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=agenda_rapat.doc");

        $data = array(
            'agenda_rapat_data' => $this->Agenda_rapat_model->get_all(),
            'start' => 0, 
            'logo_instansi' => base_url('assets/foto_profil/').$this->session->userdata('logo_instansi'),
            'nama_instansi' => $this->session->userdata('nama_instansi'),
            'alamat_instansi' => $this->session->userdata('alamat_instansi'),
            'email_instansi' => $this->session->userdata('email_instansi'),
            'notelp_instansi' => $this->session->userdata('notelp_instansi'),
            'website_instansi' => $this->session->userdata('website_instansi'),
        );
        
        $this->load->view('agenda_rapat/agenda_rapat_doc',$data);
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
        $pdf->Cell(270,6,'AGENDA RAPAT',0,1,'C');
        
        $pdf->Cell(10,10,'',0,1);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(40,6,'Tanggal Rapat',1,0,'C');
        $pdf->Cell(40,6,'Tempat',1,0,'C');
        $pdf->Cell(40,6,'Pimpinan Rapat',1,0,'C');
        $pdf->Cell(30,6,'Waktu',1,0,'C');
        $pdf->Cell(60,6,'Agenda Rapat',1,0,'C');
        $pdf->Cell(40,6,'Keterangan',1,1,'C');

       $pdf->SetFont('Times', '', 10);
       $Agenda_rapat_data = $this->Agenda_rapat_model->get_all();
        $no = 1;
        foreach($Agenda_rapat_data as $row) {
            $pdf->Cell(10,6,$no++,1,0,'C'); 
            $pdf->Cell(40,6,date_indo($row->tgl_rapat),1,0,'L');
            $pdf->Cell(40,6,$row->tempat,1,0,'L');
            $pdf->Cell(40,6,$row->pimpinan_rapat,1,0,'L');
            $pdf->Cell(30,6,$row->waktu,1,0,'C');
            $pdf->Cell(60,6,$row->agenda_rapat,1,0,'L');
            $pdf->Cell(40,6,$row->keterangan,1,1,'L');
        }
        $pdf->SetTitle('AGENDA RAPAT');
        $pdf->Output();
    }


}

/* End of file Agenda_rapat.php */
/* Location: ./application/controllers/Agenda_rapat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-09-21 17:20:08 */
/* http://harviacode.com */