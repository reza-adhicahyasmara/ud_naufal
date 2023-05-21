<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Mod_transaksi extends CI_Model {

    //==========   PEMESANAN   ==========//

    function get_all_pemesanan(){ 
        $this->db->select('pembelian.*, distributor.*, rekening.*, bank.*');
        $this->db->join('distributor', 'distributor.id_distributor = pembelian.id_distributor', 'left');
        $this->db->join('rekening', 'rekening.kode_rekening = pembelian.kode_rekening', 'left');
        $this->db->join('bank', 'bank.kode_bank = rekening.kode_bank', 'left');
        $this->db->order_by('pembelian.tanggal_pengajuan_pembelian ASC');
        return $this->db->get('pembelian'); 
    }

    function get_pemesanan($kode_pembelian){
        $this->db->select('pembelian.*, distributor.*, rekening.*, bank.*');
        $this->db->join('distributor', 'distributor.id_distributor = pembelian.id_distributor', 'left');
        $this->db->join('rekening', 'rekening.kode_rekening = pembelian.kode_rekening', 'left');
        $this->db->join('bank', 'bank.kode_bank = rekening.kode_bank', 'left');
        $this->db->where('kode_pembelian', $kode_pembelian);
        return $this->db->get('pembelian');
    }

    function get_pemesanan_distributor($id_distributor){
        $this->db->select('pembelian.*, distributor.*, rekening.*, bank.*');
        $this->db->join('distributor', 'distributor.id_distributor = pembelian.id_distributor', 'left');
        $this->db->join('rekening', 'rekening.kode_rekening = pembelian.kode_rekening', 'left');
        $this->db->join('bank', 'bank.kode_bank = rekening.kode_bank', 'left');
        $this->db->where('pembelian.id_distributor', $id_distributor);
        return $this->db->get('pembelian');
    }

    function insert_pemesanan($data){
        $insert = $this->db->insert('pembelian', $data);
        return $insert;
    }

    function update_pemesanan($kode_pembelian, $data){
        $this->db->where('kode_pembelian', $kode_pembelian);
		$this->db->update('pembelian', $data);
    }


    
    //==========   KERANJANG   ==========//

    function get_all_item_pemesanan(){ 
        $this->db->select('ipembelian.*, produk.*, distributor.*, kategori.*');
        $this->db->join('produk', 'produk.kode_produk = ipembelian.kode_produk', 'left');
        $this->db->join('distributor', 'distributor.id_distributor = produk.id_distributor', 'left');
        $this->db->join('kategori', 'kategori.kode_kategori = produk.kode_kategori', 'left');
        $this->db->order_by('produk.nama_produk ASC');
        return $this->db->get('ipembelian'); 
    }

    function get_item_pembelian($kode_ipembelian){ 
        $this->db->select('ipembelian.*, produk.*, distributor.*, kategori.*');
        $this->db->join('produk', 'produk.kode_produk = ipembelian.kode_produk', 'left');
        $this->db->join('distributor', 'distributor.id_distributor = produk.id_distributor', 'left');
        $this->db->join('kategori', 'kategori.kode_kategori = produk.kode_kategori', 'left');
        $this->db->where('ipembelian.kode_ipembelian', $kode_ipembelian);
        $this->db->order_by('produk.nama_produk ASC');
        return $this->db->get('ipembelian'); 
    }

    function get_item_pemesanan_distributor($id_distributor){ 
        $this->db->select('ipembelian.*, produk.*, distributor.*, kategori.*');
        $this->db->join('produk', 'produk.kode_produk = ipembelian.kode_produk', 'left');
        $this->db->join('distributor', 'distributor.id_distributor = produk.id_distributor', 'left');
        $this->db->join('kategori', 'kategori.kode_kategori = produk.kode_kategori', 'left');
        $this->db->where('ipembelian.id_distributor', $id_distributor);
        $this->db->order_by('produk.nama_produk ASC');
        return $this->db->get('ipembelian'); 
    }

    function get_item_pemesanan($kode_pembelian){ 
        $this->db->select('ipembelian.*, produk.*, distributor.*, kategori.*');
        $this->db->join('produk', 'produk.kode_produk = ipembelian.kode_produk', 'left');
        $this->db->join('distributor', 'distributor.id_distributor = produk.id_distributor', 'left');
        $this->db->join('kategori', 'kategori.kode_kategori = produk.kode_kategori', 'left');
        $this->db->where('ipembelian.kode_pembelian', $kode_pembelian);
        return $this->db->get('ipembelian'); 
    }

    function cek_proses_packing($kode_pembelian){ 
        $this->db->where('kode_pembelian', $kode_pembelian);
        $this->db->where('status_ipembelian', "Proses");
        return $this->db->get('ipembelian'); 
    }

    function cek_item_pemesanan($kode_produk){
        $this->db->join('produk', 'produk.kode_produk = ipembelian.kode_produk', 'left');
        $this->db->where('produk.kode_produk', $kode_produk);
        $this->db->where('ipembelian.status_ipembelian', 'Keranjang');
        return $this->db->get('ipembelian');
    }

    function cek_item_produk_retur($kode_pembelian){ 
        $this->db->where('kode_pembelian', $kode_pembelian);
        $this->db->where('status_ipembelian = "Retur"');
        return $this->db->get('ipembelian'); 
    }

    function cek_item_produk_kirim($kode_pembelian){ 
        $this->db->where('kode_pembelian', $kode_pembelian);
        $this->db->where('status_ipembelian = "Dikirim"');
        return $this->db->get('ipembelian'); 
    }

    function insert_item_pemesanan($data){
        $insert = $this->db->insert('ipembelian', $data);
        return $insert;
    }

    function update_item_pemesanan($kode_ipembelian, $data){
        $this->db->where('kode_ipembelian', $kode_ipembelian);
		$this->db->update('ipembelian', $data);
    }

    function delete_item_pemesanan($kode){
        $this->db->where('kode_ipembelian', $kode);
        $this->db->delete('ipembelian');
    }
    

    
    //PERULANGAN
    function getValueOfTable($tableName,$column,$where){
		$this->db->select($column);
		$this->db->from($tableName);
		
		foreach($where as $key => $value){
			$this->db->where($key,$value);
		}

		$query = $this->db->get()->row();
		return $query->$column;
	}


}