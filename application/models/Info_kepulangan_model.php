<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Info_kepulangan_model extends CI_Model
{

    public $table = 'info_kepulangan';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,tgl_penerbangan,nama_maskapai,jam_berangkat,jam_datang,harga_tiket,transit,sumber,pimpinan_id');
        $this->datatables->from('info_kepulangan');
        //add this line for join
        //$this->datatables->join('table2', 'info_kepulangan.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('info_kepulangan/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('info_kepulangan/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('info_kepulangan/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get data by idpimpinan
    function get_by_idpimpinan($idpimpinan)
    {
        $this->db->where('pimpinan_id', $idpimpinan);
        return $this->db->get($this->table)->result();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('tgl_penerbangan', $q);
	$this->db->or_like('nama_maskapai', $q);
	$this->db->or_like('jam_berangkat', $q);
	$this->db->or_like('jam_datang', $q);
	$this->db->or_like('harga_tiket', $q);
	$this->db->or_like('transit', $q);
	$this->db->or_like('sumber', $q);
	$this->db->or_like('pimpinan_id', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $idpimpinan) {
        $this->db->order_by($this->id, $this->order);
        /*
        $this->db->like('id', $q);
        $this->db->or_like('tgl_penerbangan', $q);
        $this->db->or_like('nama_maskapai', $q);
        $this->db->or_like('jam_berangkat', $q);
        $this->db->or_like('jam_datang', $q);
        $this->db->or_like('harga_tiket', $q);
        $this->db->or_like('transit', $q);
        $this->db->or_like('sumber', $q);
        $this->db->or_like('pimpinan_id', $q);
        */
        $this->db->where('pimpinan_id',$idpimpinan);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Info_kepulangan_model.php */
/* Location: ./application/models/Info_kepulangan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-09-14 06:48:31 */
/* http://harviacode.com */