<?php

class DetailTransaksis extends \Phalcon\Mvc\Model
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
    public $transaksi_id;

    /**
     *
     * @var integer
     */
    public $kategori_bantuan_id;

    /**
     *
     * @var integer
     */
    public $jumlah;

    /**
     *
     * @var string
     */
    public $keterangan;

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
        $this->setSource("Detail_Transaksis");

        $this->hasOne(
            'id',
            'Transaksis',
            'transaksi_id'
        );

        $this->belongsTo(
            'kategori_bantuan_id',
            'KategoriBantuans',
            'id'
        );
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return DetailTransaksis[]|DetailTransaksis|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return DetailTransaksis|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function getKategoriBantuans($parameters = null)
    {
        return $this->getRelated('KategoriBantuans', $this->id);
    }
}
