<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Mod_master extends CI_Model {

    //==========   KARYAWAN   ==========//
    function get_all_karyawan(){ 
        $this->db->order_by('nama_karyawan ASC');
        return $this->db->get('karyawan'); 
    }

    function get_karyawan($id_karyawan){
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->order_by('nama_karyawan ASC');
        return $this->db->get('karyawan');
    }
    
    function get_username_karyawan($username_karyawan){
        $this->db->where('username_karyawan', $username_karyawan);
        return $this->db->get('karyawan');
    }
    
    function get_kontak_karyawan($kontak_karyawan){
        $this->db->where('kontak_karyawan', $kontak_karyawan);
        return $this->db->get('karyawan');
    }

    function get_email_karyawan($email_karyawan){
        $this->db->where('email_karyawan', $email_karyawan);
        return $this->db->get('karyawan');
    }

    function insert_karyawan($data){
        $this->db->insert('karyawan', $data);
    }

    function update_karyawan($id_karyawan, $data){
        $this->db->where('id_karyawan', $id_karyawan);
		$this->db->update('karyawan', $data);
    }

    function delete_karyawan($id_karyawan){
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->delete('karyawan');
    }

    function auth_karyawan($username_karyawan, $password_karyawan){
        $this->db->where('username_karyawan ', $username_karyawan);
        $this->db->where('password_karyawan ', $password_karyawan);
        return $this->db->get('karyawan');
    }

    

    //==========   DISTRIBUTOR   ==========//
    function get_all_distributor(){ 
        $this->db->order_by('nama_distributor ASC');
        return $this->db->get('distributor'); 
    }

    function get_distributor($id_distributor){
        $this->db->where('id_distributor', $id_distributor);
        $this->db->order_by('nama_distributor ASC');
        return $this->db->get('distributor');
    }
    
    function get_username_distributor($username_distributor){
        $this->db->where('username_distributor', $username_distributor);
        return $this->db->get('distributor');
    }

    function insert_distributor($data){
        $this->db->insert('distributor', $data);
    }

    function update_distributor($id_distributor, $data){
        $this->db->where('id_distributor', $id_distributor);
		$this->db->update('distributor', $data);
    }

    function delete_distributor($id_distributor){
        $this->db->where('id_distributor', $id_distributor);
        $this->db->delete('distributor');
    }

    function auth_distributor($username, $password){
        $this->db->where('username_distributor', $username);
        $this->db->where('password_distributor', $password);
        return $this->db->get('distributor');
    }

    

    //==========   KATEGORI   ==========//
    function get_all_kategori(){ 
        $this->db->order_by('nama_kategori ASC');
        return $this->db->get('kategori'); 
    }

    function get_kategori($kode_kategori){
        $this->db->where('kode_kategori', $kode_kategori);
        $this->db->order_by('nama_kategori ASC');
        return $this->db->get('kategori');
    }

    function insert_kategori($data){
        $this->db->insert('kategori', $data);
    }

    function update_kategori($kode_kategori, $data){
        $this->db->where('kode_kategori', $kode_kategori);
		$this->db->update('kategori', $data);
    }

    function delete_kategori($kode_kategori){
        $this->db->where('kode_kategori', $kode_kategori);
        $this->db->delete('kategori');
    }

    

    //==========   KATEGORI   ==========//
    function get_all_produk(){ 
        $this->db->select('produk.*, distributor.*, kategori.*, penawaran.*, produk.id_distributor AS ID');
        $this->db->join('distributor', 'distributor.id_distributor = produk.id_distributor', 'inner');
        $this->db->join('kategori', 'kategori.kode_kategori = produk.kode_kategori', 'inner');
        $this->db->join('penawaran', 'penawaran.kode_penawaran = produk.kode_penawaran', 'left');
        $this->db->order_by('produk.nama_produk ASC');
        return $this->db->get('produk'); 
    }

    function get_produk($kode_produk){
        $this->db->select('produk.*, distributor.*, kategori.*');
        $this->db->join('distributor', 'distributor.id_distributor = produk.id_distributor', 'inner');
        $this->db->join('kategori', 'kategori.kode_kategori = produk.kode_kategori', 'inner');
        $this->db->where('kode_produk', $kode_produk);
        return $this->db->get('produk');
    }

    function get_produk_distributor($id_distributor){
        $this->db->select('produk.*, distributor.*, kategori.*');
        $this->db->join('distributor', 'distributor.id_distributor = produk.id_distributor', 'inner');
        $this->db->join('kategori', 'kategori.kode_kategori = produk.kode_kategori', 'inner');
        $this->db->where('produk.id_distributor', $id_distributor);
        return $this->db->get('produk');
    }

    function cek_produk($nama_produk){
        $this->db->where('nama_produk', $nama_produk);
        return $this->db->get('produk');
    }

    function cek_produk_penawaran($kode_penawaran){
        $this->db->where('status_penawaran_produk', 'Penawaran');
        $this->db->where('kode_penawaran', $kode_penawaran);
        return $this->db->get('produk');
    }

    function insert_produk($data){
        $this->db->insert('produk', $data);
    }

    function update_produk($kode_produk, $data){
        $this->db->where('kode_produk', $kode_produk);
		$this->db->update('produk', $data);
    }

    function delete_produk($kode){
        $this->db->where('kode_produk', $kode);
        $this->db->delete('produk');
    }

    function delete_all_produk($kode){
        $this->db->where('kode_produk', $kode);
        $this->db->delete('produk');
    }

    

    //==========   PENAWARAN   ==========//

    function get_all_penawaran_distributor(){ 
        $this->db->select('penawaran.*, distributor.*');
        $this->db->join('distributor', 'distributor.id_distributor = penawaran.id_distributor', 'left');
        $this->db->order_by('penawaran.tanggal_penawaran DESC');
        return $this->db->get('penawaran'); 
    }
    
    function get_penawaran_distributor($id_distributor){ 
        $this->db->select('penawaran.*, distributor.*');
        $this->db->join('distributor', 'distributor.id_distributor = penawaran.id_distributor', 'left');
        $this->db->where('penawaran.id_distributor', $id_distributor);
        $this->db->order_by('penawaran.tanggal_penawaran DESC');
        return $this->db->get('penawaran'); 
    }

    function get_penawaran($kode_penawaran){
        $this->db->where('kode_penawaran', $kode_penawaran);
        return $this->db->get('penawaran');
    }

    function insert_penawaran($data){
        $this->db->insert('penawaran', $data);
    }

    function update_penawaran($kode_penawaran, $data){
        $this->db->where('kode_penawaran', $kode_penawaran);
		$this->db->update('penawaran', $data);
    }

    function delete_penawaran($kode){
        $this->db->where('kode_penawaran', $kode);
        $this->db->delete('penawaran');
    }
}