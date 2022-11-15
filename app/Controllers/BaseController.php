<?php

namespace App\Controllers;

use App\Models\AkumulasiPenyusutanModel;
use App\Models\AkunCatModel;
use App\Models\AkunModel;
use App\Models\AsetBeliModel;
use App\Models\AsetJualModel;
use App\Models\AsetModel;
use App\Models\AsetPenyusutanModel;
use App\Models\DiskonModel;
use App\Models\JenisPembayaranModel;
use App\Models\JenisTunjanganModel;
use App\Models\KasKeluarModel;
use App\Models\KasMasukModel;
use App\Models\PajakModel;
use App\Models\PembayaranGajiModel;
use App\Models\PembayaranTunjanganModel;
use App\Models\PendapatanModel;
use App\Models\PengajuanModel;
use App\Models\PengeluaranHarianModel;
use App\Models\PengeluaranModel;
use App\Models\ProdukCatModel;
use App\Models\ProdukJualModel;
use App\Models\ProdukJualDetModel;
use App\Models\ProdukModel;
use App\Models\ProfileModel;
use App\Models\StafGajiModel;
use App\Models\StafTunjanganModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Myth\Auth\Models\UserModel;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['auth', 'dateindo'];

	/**
	 * 
	 * 
	 * 
	 */
	protected $request;

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();

		// Model
		$this->akunModel 				= new AkunModel(); // akun
		$this->akunCatModel 			= new AkunCatModel(); // kategori akun
		$this->asetModel 				= new AsetModel(); // aset
		$this->asetBeliModel 			= new AsetBeliModel(); // pembelian aset
		$this->asetJualModel 			= new AsetJualModel(); // penjualan aset
		$this->asetPenyusutanModel 		= new AsetPenyusutanModel(); // penyusutan aset
		$this->akumPenyusutanModel 		= new AkumulasiPenyusutanModel(); // akumulasi penyusutan
		$this->produkModel 				= new ProdukModel(); // produk
		$this->produkCatModel 			= new ProdukCatModel(); // kategori produk
		$this->produkDiskonModel 		= new DiskonModel(); // diskon produk
		$this->produkJualModel 			= new ProdukJualModel(); // penjualan produk
		$this->produkJualDetModel 		= new ProdukJualDetModel(); // penjualan produk detail
		$this->jenisPembayaranModel 	= new JenisPembayaranModel(); // jenis pembayaran
		$this->pajakModel 				= new PajakModel(); // pajak
		$this->pendapatanModel 			= new PendapatanModel(); // pendapatan
		$this->pengeluaranModel 		= new PengeluaranModel(); // pengeluaran
		$this->pengeluaranHarianModel 	= new PengeluaranHarianModel(); // pengeluaran harian
		$this->pengajuanModel			= new PengajuanModel(); // pengajuan
		$this->jenisTunjanganModel 		= new JenisTunjanganModel(); // jenis tunjangan
		$this->tunjanganModel 			= new StafTunjanganModel(); // tunjangan staf
		$this->tunjanganBayarModel 		= new PembayaranTunjanganModel(); // pembayaran tunjangan
		$this->gajiModel 				= new StafGajiModel(); // gaji staf
		$this->gajiBayarModel 			= new PembayaranGajiModel(); // pembayaran gaji
		$this->kasMasukModel 			= new KasMasukModel(); // kas masuk
		$this->kasKeluarModel 			= new KasKeluarModel(); // kas keluar
		$this->userModel 				= new UserModel(); // user
		$this->profileModel				= new ProfileModel(); // profile

		// Lainnya
		$this->dateNow = date('Y-m-d'); // hari
		$this->datetimeNow = date('Y-m-d H:i:s'); // hari + tgl
		$this->validation = \Config\Services::validation(); // validasi
		$this->session = \Config\Services::session(); // session
		$this->db = \Config\Database::connect(); // database
		// session(); // session
	}
}
