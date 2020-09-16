<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }
 
    public function index()
    {
        $this->template->load('template','user/tbl_user_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->User_model->json();
    }

    public function read($id) 
    {
        $row = $this->User_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_users'      => $row->id_users,
		'full_name'     => $row->full_name,
		'email'         => $row->email,
		'password'      => $row->password,
		'images'        => $row->images,
		'id_user_level' => $row->id_user_level,
		'is_aktif'      => $row->is_aktif,
	    );
            $this->template->load('template','user/tbl_user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function create() 
    {
        $data = array(
            'button'        => 'Create',
            'action1'        => site_url('user/create_user'),
            'action2'        => site_url('user/create_instansi'),
    	    'id_users'      => set_value('id_users'),
    	    'full_name'     => set_value('full_name'),
    	    'email'         => set_value('email'),
    	    'password'      => set_value('password'),
    	    'images'        => set_value('images'),
    	    'id_user_level' => set_value('id_user_level'),
    	    'is_aktif'      => set_value('is_aktif'),  
            'nama_instansi'      => set_value('nama_instansi'),
            'alamat_instansi'      => set_value('alamat_instansi'),
            'notelp_instansi'      => set_value('notelp_instansi'),
            'email_instansi'      => set_value('email_instansi'),
            'website_instansi'      => set_value('website_instansi'),
            'logo_instansi'      => set_value('logo_instansi'),      
    	);
        $this->template->load('template','user/tbl_user_form', $data);
    }
    
    
    public function create_user() 
    {
        $this->_rules1();
        $foto = $this->upload_foto();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $password       = $this->input->post('password',TRUE);
            $options        = array("cost"=>4);
            $hashPassword   = password_hash($password,PASSWORD_BCRYPT,$options);
            
            $data = array(
        		'full_name'     => $this->input->post('full_name',TRUE),
        		'email'         => $this->input->post('email',TRUE),
        		'password'      => $hashPassword,
        		'images'        => $foto['file_name'],
        		'id_user_level' => $this->input->post('id_user_level',TRUE),
        		'is_aktif'      => $this->input->post('is_aktif',TRUE),
	        );

            $this->User_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('user'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'        => 'Update',
                'action1'        => site_url('user/update_user'),
                'action2'        => site_url('user/update_instansi'),
        		'id_users'      => set_value('id_users', $row->id_users),
        		'full_name'     => set_value('full_name', $row->full_name),
        		'email'         => set_value('email', $row->email),
        		'password'      => set_value('password', $row->password),
        		'images'        => set_value('images', $row->images),
        		'id_user_level' => set_value('id_user_level', $row->id_user_level),
        		'is_aktif'      => set_value('is_aktif', $row->is_aktif),
                'nama_instansi'      => set_value('nama_instansi',$row->nama_instansi),
                'alamat_instansi'      => set_value('alamat_instansi',$row->alamat_instansi),
                'notelp_instansi'      => set_value('notelp_instansi',$row->notelp_instansi),
                'email_instansi'      => set_value('email_instansi',$row->email_instansi),
                'website_instansi'      => set_value('website_instansi',$row->website_instansi),
                'logo_instansi'      => set_value('logo_instansi',$row->logo_instansi),
        	);
            $this->template->load('template','user/tbl_user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }
    
    public function update_user() 
    {
        $this->_rules1();
        $foto = $this->upload_foto();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_users', TRUE));
        } else {
            if($foto['file_name']==''){
                $data = array(
            		'full_name'     => $this->input->post('full_name',TRUE),
            		'email'         => $this->input->post('email',TRUE),
            		'id_user_level' => $this->input->post('id_user_level',TRUE),
            		'is_aktif'      => $this->input->post('is_aktif',TRUE));
            }else{
                $data = array(
            		'full_name'     => $this->input->post('full_name',TRUE),
            		'email'         => $this->input->post('email',TRUE),
                    'images'        => $foto['file_name'],
            		'id_user_level' => $this->input->post('id_user_level',TRUE),
            		'is_aktif'      => $this->input->post('is_aktif',TRUE));
                 
                // ubah nama dan foto profil yang aktif
                $this->session->set_userdata('full_name',$this->input->post('full_name',TRUE));
                $this->session->set_userdata('images',$foto['file_name']);
            }

            $this->User_model->update($this->input->post('id_users', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('welcome'));
        }
    }

    public function update_instansi() 
    {
        $this->_rules2();
        $logo = $this->upload_logo();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_users', TRUE));
        } else {
            if($logo['file_name']==''){
                $data = array(
                    'nama_instansi'      => $this->input->post('nama_instansi',TRUE),
                    'alamat_instansi'      => $this->input->post('alamat_instansi',TRUE),
                    'notelp_instansi'      => $this->input->post('notelp_instansi',TRUE),
                    'email_instansi'      => $this->input->post('email_instansi',TRUE),
                    'website_instansi'      => $this->input->post('website_instansi',TRUE));
            }else{
                $data = array(
                    'nama_instansi'      => $this->input->post('nama_instansi',TRUE),
                    'alamat_instansi'      => $this->input->post('alamat_instansi',TRUE),
                    'notelp_instansi'      => $this->input->post('notelp_instansi',TRUE),
                    'email_instansi'      => $this->input->post('email_instansi',TRUE),
                    'website_instansi'      => $this->input->post('website_instansi',TRUE),
                    'logo_instansi'        => $logo['file_name']);
            }

            $this->User_model->update($this->input->post('id_users', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('welcome'));
        }
    }
    
    
    function upload_foto(){
        $config['upload_path']          = './assets/foto_profil';
        $config['allowed_types']        = 'gif|jpg|png';
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $this->load->library('upload', $config);
        $this->upload->do_upload('images');
        return $this->upload->data();
    }

    function upload_logo(){
        $config['upload_path']          = './assets/foto_profil';
        $config['allowed_types']        = 'gif|jpg|png';
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $this->load->library('upload', $config);
        $this->upload->do_upload('logo_instansi');
        return $this->upload->data();
    }
    
    public function delete($id) 
    {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $this->User_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function _rules1() 
    {
	$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'trim|required');
	$this->form_validation->set_rules('email', 'Email' , 'trim|required');
	$this->form_validation->set_rules('id_user_level', 'Level User', 'trim|required');
	$this->form_validation->set_rules('is_aktif', 'Status Aktif', 'trim|required');

	$this->form_validation->set_rules('id_users', 'id_users', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules2() 
    {
    $this->form_validation->set_rules('nama_instansi', 'Nama Instansi', 'trim|required');
    $this->form_validation->set_rules('alamat_instansi', 'Alamat Instansi', 'trim|required');
    $this->form_validation->set_rules('notelp_instansi', 'No.Telp Instansi', 'trim|required');
    $this->form_validation->set_rules('email_instansi', 'Email Instansi', 'trim|required');
    $this->form_validation->set_rules('website_instansi', 'Website Instansi', 'trim|required');

    $this->form_validation->set_rules('id_users', 'id_users', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_user.xls";
        $judul = "tbl_user";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Full Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Password");
	xlsWriteLabel($tablehead, $kolomhead++, "Images");
	xlsWriteLabel($tablehead, $kolomhead++, "Id User Level");
	xlsWriteLabel($tablehead, $kolomhead++, "Is Aktif");

	foreach ($this->User_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->full_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
	    xlsWriteLabel($tablebody, $kolombody++, $data->images);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_user_level);
	    xlsWriteLabel($tablebody, $kolombody++, $data->is_aktif);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_user.doc");

        $data = array(
            'tbl_user_data' => $this->User_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('user/tbl_user_doc',$data);
    }
    
    function profile(){
        
    }

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-04 06:32:22 */
/* http://harviacode.com */