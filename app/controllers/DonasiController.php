<?php
declare(strict_types=1);

use Phalcon\Mvc\Model\Query;
use Phalcon\Di;
class DonasiController extends ControllerBase
{
    public function initialize()
    {
        if (!$this->session->has('auth')) {
            $this->flash->error('Anda harus login!');
            return $this->response->redirect('/');
        }
        parent::initialize();

        $this->tag->setTitle('Halaman Donasi');
    }

    public function indexAction()
    {
        $donasis = Transaksis::find();
        $kategori_bantuans = KategoriBantuans::find();

        $this->view->donasis = $donasis;
        $this->view->kategori_bantuans = $kategori_bantuans;
    }

    public function detailAction($transaksiId)
    {
        $donasi = $this->db->fetchAll("SELECT * FROM detail_transaksis dt JOIN kategori_bantuans kb ON kb.id = dt.kategori_bantuan_id JOIN transaksis t ON t.id = dt.transaksi_id JOIN users u ON u.id = t.user_id WHERE t.id = ".$transaksiId);
        // die(print_r($donasi, true));
        $this->view->donasi = $donasi;
    }

    public function donasiperkategoriAction($kategoriId = 1)
    {
        $countPerKategori = $this->db->fetchAll("SELECT kb.id , kb.nama_kategori, COUNT(*) AS count FROM transaksis t JOIN detail_transaksis dt on t.id = dt.transaksi_id JOIN kategori_bantuans kb on kb.id = dt.kategori_bantuan_id GROUP BY kb.id");
        $namaKategori = $this->db->fetchAll("SELECT kb.nama_kategori FROM transaksis t JOIN detail_transaksis dt on t.id = dt.transaksi_id JOIN kategori_bantuans kb on kb.id = dt.kategori_bantuan_id GROUP BY kb.id");
        $donasiPerKategori = $this->db->fetchAll("SELECT dt.*, u.name, t.keterangan FROM detail_transaksis dt JOIN transaksis t ON t.id = dt.transaksi_id JOIN users u ON u.id = t.user_id JOIN kategori_bantuans kb ON kb.id = dt.kategori_bantuan_id WHERE kb.id = ".$kategoriId);
        $kategori_bantuans = KategoriBantuans::find();

        $kategori_satu = $this->db->fetchAll("SELECT nama_kategori FROM kategori_bantuans WHERE id = ". $kategoriId);

        // die(print_r($countPerKategori, true));

        $this->view->countPerKategori = $countPerKategori;
        $this->view->donasiPerKategori = $donasiPerKategori;
        $this->view->kategori_bantuans = $kategori_bantuans;
        $this->view->kategori_satu = $kategori_satu[0];
        $this->view->namaKategori = $namaKategori;
    }

    public function storeAction()
    {
        if ($this->request->isPost()) {
            $transaksi = new Transaksis();
            // die(print_r($this->session->auth['id'], true));
            $transaksi->user_id = $this->session->auth['id'];
            $transaksi->keterangan = $this->request->getPost('keterangan');
            
            if (!$transaksi->save()) {
                foreach ($transaksi->getMessages() as $message) {
                    $this->flash->error((string)$message);
                }

                $this->dispatcher->forward([
                    'controller' => 'donasi',
                    'action'     => 'index'
                ]);
    
                return;
            }

            if (!empty($this->request->getPost('kategori'))) {
                foreach ($this->request->getPost('kategori') as $key => $value) {
                    $detailTransaksi = new DetailTransaksis();
                    $detailTransaksi->transaksi_id = $transaksi->id;
                    $detailTransaksi->kategori_bantuan_id = $value;
                    $detailTransaksi->jumlah = $this->request->getPost('jumlah_'.$value);

                    if (!$detailTransaksi->save()) {
                        foreach ($detailTransaksi->getMessages() as $message) {
                            $this->flash->error((string)$message);
                        }
        
                        $this->dispatcher->forward([
                            'controller' => 'donasi',
                            'action'     => 'index'
                        ]);
            
                        return;
                    }
                }
            }
            
            $this->flash->success('Data berhasil ditambah');
            // redirect
            return $this->dispatcher->forward(array(
                'controller' => 'donasi',
                'action'     => 'index'
            ));
        }
    }
}

