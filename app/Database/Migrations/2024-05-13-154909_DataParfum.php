<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataParfum extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 255,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'pendapatan' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2', // 10 digit total, 2 di antaranya untuk pecahan
            ],
            'modal' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('data_parfum');
    }

    public function down()
    {
        $this->forge->dropTable('data_parfum');
    }
}
