<?php
declare(strict_types=1);

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

    public function storeAction()
    {
        if ($this->request->isPost()) {
            $transaksi = new Transaksis();
            // die(print_r($this->session->auth['id'], true));
            $transaksi->user_id = $this->session->auth['id'];
            
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
                    $detailTransaksi->keterangan = $this->request->getPost('keterangan');

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
            

            // redirect
            // return $this->dispatcher->forward(array(
            //     'action' => 'show',
            //     'params' => array($pollId)
            // ));
        }
    }
}

