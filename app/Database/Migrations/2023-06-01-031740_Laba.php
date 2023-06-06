<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Laba extends Migration
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
            'kategori'   => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'kode_akun'  => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'cabang'     => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'dana'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'unsigned'   => true,
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
        $this->forge->createTable('laba');
    }

    public function down()
    {
        $this->forge->dropTable('laba');
    }
}
