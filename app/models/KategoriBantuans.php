<?php

class KategoriBantuans extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $nama_kategori;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("fp_pbkk");
        $this->setSource("Kategori_Bantuans");

        $this->hasMany(
            'id',
            'DetailTransaksis',
            'kategori_bantuan_id'
        );
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return KategoriBantuans[]|KategoriBantuans|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return KategoriBantuans|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
