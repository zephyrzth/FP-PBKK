<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class TransaksisMigration_100
 */
class TransaksisMigration_100 extends Migration
{
    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
        $this->morphTable('transaksis', [
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
                    'user_id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'unsigned' => true,
                        'size' => 10,
                        'after' => 'id'
                    ]
                ),
                new Column(
                    'created_at',
                    [
                        'type' => Column::TYPE_TIMESTAMP,
                        'default' => "CURRENT_TIMESTAMP",
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'user_id'
                    ]
                )
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY'),
                new Index(
                    'user_id',
                    [
                        'user_id',
                    ]
                ),
            ],
            'references' => [
                new Reference(
                    'transaksis_ibfk_1',
                    [
                        'referencedSchema'  => 'fp_pbkk',
                        'referencedTable'   => 'users',
                        'columns'           => ['user_id'],
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
        $this->batchDelete('transaksis');
    }
}
