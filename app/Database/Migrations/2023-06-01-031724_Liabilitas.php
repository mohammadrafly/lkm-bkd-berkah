<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Liabilitas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'author'     => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'cabang'      => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'dana'        => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'unsigned'   => true,
            ],
            'keterangan'  => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'nasabah'      => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'created_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('liabilitas');
    }

    public function down()
    {
        $this->forge->dropTable('liabilitas');
    }
}
