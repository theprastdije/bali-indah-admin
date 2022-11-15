<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
	protected $table = 'produk';
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'kategori_produk_id', 'nama_produk', 'deskripsi_produk', 'harga_produk', 'created_at', 'updated_at'
	];

	public function getProduk($produk_id = false)
	{
		if ($produk_id == false) {
			return $this->builder()
				->select('produk.*, kategori_produk.kode_kategori_produk, kategori_produk.nama_kategori_produk')
				->join('kategori_produk', 'kategori_produk.id = produk.kategori_produk_id')
				->get()->getResultArray();
		} else {
			return $this->builder()
				->select('produk.*, kategori_produk.kode_kategori_produk, kategori_produk.nama_kategori_produk')
				->where('produk.id', $produk_id)
				->join('kategori_produk', 'kategori_produk.id = produk.kategori_produk_id')
				->get()->getRowArray();
		}
	}
}
