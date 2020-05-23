<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class TransaksisMigration_100
 */
class DetailTransaksisMigration_100 extends Migration
{
    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
        $this->morphTable('detail_transaksis', [
            'columns' => [
                new Column(
                    'id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 10,
                        'first' => true
                    ]
                ),
                new Column(
                    'transaksi_id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'unsigned' => true,
                        'size' => 10,
                        'after' => 'id'
                    ]
                ),
                new Column(
                    'kategori_bantuan_id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'unsigned' => true,
                        'size' => 10,
                        'after' => 'transaksi_id'
                    ]
                ),
                new Column(
                    'jumlah',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => false,
                        'size' => 10,
                        'after' => 'kategori_bantuan_id'
                    ]
                ),
                new Column(
                    'keterangan',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => false,
                        'size' => 100,
                        'after' => 'jumlah'
                    ]
                ),
                new Column(
                    'created_at',
                    [
                        'type' => Column::TYPE_TIMESTAMP,
                        'default' => "CURRENT_TIMESTAMP",
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'keterangan'
                    ]
                )
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY'),
                new Index(
                    'transaksi_id',
                    [
                        'transaksi_id',
                    ]
                ),
                new Index(
                    'kategori_bantuan_id',
                    [
                        'kategori_bantuan_id',
                    ]
                ),
            ],
            'references' => [
                new Reference(
                    'detail_transaksis_ibfk_1',
                    [
                        'referencedSchema'  => 'fp_pbkk',
                        'referencedTable'   => 'transaksis',
                        'columns'           => ['transaksi_id'],
                        'referencedColumns' => ['id'],
                    ]
                ),
                new Reference(
                    'detail_transaksis_ibfk_2',
                    [
                        'referencedSchema'  => 'fp_pbkk',
                        'referencedTable'   => 'kategori_bantuans',
                        'columns'           => ['kategori_bantuan_id'],
                        'referencedColumns' => ['id'],
                    ]
                )
            ],
            'options' => [
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '1',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_unicode_ci'
            ]
        ]);
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {
        $this->batchDelete('detail_transaksis');
    }
}
