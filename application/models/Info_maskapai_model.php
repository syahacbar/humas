<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Info_maskapai_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    } 

    // datatables
    function json() {
        $this->datatables->select('id,tgl_penerbangan,nama_maskapai,jam_berangkat,jam_datang,harga_tiket,transit,sumber,pimpinan_id');
        $this->datatables->from('info_keberangkatan');
        //add this line for join
        //$this->datatables->join('table2', 'info_keberangkatan.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('info_keberangkatan/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('info_keberangkatan/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('info_keberangkatan/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_idpimpinan($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

}

/* End of file Info_keberangkatan_model.php */
/* Location: ./application/models/Info_keberangkatan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-09-14 06:48:35 */
/* http://harviacode.com */