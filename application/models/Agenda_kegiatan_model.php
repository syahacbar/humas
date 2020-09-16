<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agenda_kegiatan_model extends CI_Model
{

    public $table = 'agenda_kegiatan';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,tanggal,waktu,tempat,kegiatan,keterangan,pimpinan_id');
        $this->datatables->from('agenda_kegiatan');
        //add this line for join
        //$this->datatables->join('table2', 'agenda_kegiatan.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('agenda_kegiatan/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('agenda_kegiatan/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('agenda_kegiatan/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
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
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('tanggal', $q);
	$this->db->or_like('waktu', $q);
	$this->db->or_like('tempat', $q);
	$this->db->or_like('kegiatan', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->or_like('pimpinan_id', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('tanggal', $q);
	$this->db->or_like('waktu', $q);
	$this->db->or_like('tempat', $q);
	$this->db->or_like('kegiatan', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->or_like('pimpinan_id', $q);
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

/* End of file Agenda_kegiatan_model.php */
/* Location: ./application/models/Agenda_kegiatan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-09-14 06:31:35 */
/* http://harviacode.com */