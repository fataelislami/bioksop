<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tiket_model extends CI_Model
{

    public $table = 'tiket';
    public $id = 'id_tiket';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    //get field
    function get_field(){
      return $this->db->list_fields($this->table);
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }


    function get_id_jadwal($id_studio,$id_film,$id_jam_tayang){
      $sql="SELECT id_jadwal FROM `jadwal` where id_studio=$id_studio and id_film='$id_film' and id_jam_tayang=$id_jam_tayang";
      return $this->db->query($sql)->row();
    }

    function get_id_kursi($no_baris,$no_kursi){
      $sql="SELECT `id_kursi` FROM `kursi` WHERE `no_baris`=$no_baris and `no_kursi`=$no_kursi";
      return $this->db->query($sql)->row();//ROw kan jika satu data
    }

    function get_kursi($id_jadwal,$tanggal_tayang){
      $sql="SELECT concat(no_baris,'_',no_kursi) as no_kursi FROM `tiket` JOIN `kursi` using (`id_kursi`) where `id_jadwal`=$id_jadwal and `tanggal_tayang`='$tanggal_tayang'";
      return $this->db->query($sql)->result();
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_tiket', $q);
	$this->db->or_like('id_transaksi', $q);
	$this->db->or_like('id_jadwal', $q);
	$this->db->or_like('id_kursi', $q);
	$this->db->or_like('tanggal_tayang', $q);
	$this->db->or_like('username', $q);
	$this->db->or_like('date_create', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_tiket', $q);
	$this->db->or_like('id_transaksi', $q);
	$this->db->or_like('id_jadwal', $q);
	$this->db->or_like('id_kursi', $q);
	$this->db->or_like('tanggal_tayang', $q);
	$this->db->or_like('username', $q);
	$this->db->or_like('date_create', $q);
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

/* End of file Tiket_model.php */
/* Location: ./application/models/Tiket_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-07-23 00:56:08 */
/* http://harviacode.com */
