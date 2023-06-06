<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mutasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'author'     => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'cabang'     => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'dana'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kategori'   => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'waktu'      => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'nasabah'      => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('mutasi');
    }

    public function down()
    {
        $this->forge->dropTable('mutasi');
    }
}
