<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class POS2 extends Migration
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
            'kode_akun'  => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'cabang'     => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'dana'     => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('pos2');
    }

    public function down()
    {
        $this->forge->dropTable('pos2');
    }
}
