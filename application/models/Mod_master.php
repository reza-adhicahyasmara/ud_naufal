<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Mod_master extends CI_Model {

    //==========KARYAWAN==========//
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

    

    //==========KARYAWAN==========//
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
}