<?php

class Transaksis extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $user_id;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("fp_pbkk");
        $this->setSource("Transaksis");

        $this->hasOne(
            'id',
            'DetailTransaksis',
            'transaksi_id'
        );

        $this->belongsTo(
            'user_id',
            'Users',
            'id'
        );
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Transaksis[]|Transaksis|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Transaksis|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function getDetailTransaksis($parameters = null)
    {
        return $this->getRelated('DetailTransaksis', $parameters);
    }

    public function getNamaBantuanAsArray($parameters = null)
    {
        $detailTransaksis = DetailTransaksis::find("transaksi_id = ".$this->id);
        $kategoriBantuans = [];
        foreach ($detailTransaksis as $detailTransaksi) {
            $kategoriBantuans[] = $detailTransaksi->kategoribantuans->nama_kategori;
        }

        return $kategoriBantuans;
    }
}
