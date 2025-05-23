<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admins extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'name' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255'
            ],
            'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'password' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'created_at' => [
                'type'           => 'TIMESTAMP',
                'null'           => true,
            ],
                'updated_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            
        ]);
        
        $this->forge->addKey('id', TRUE);
        // Mengubah nama tabel dari 'users' menjadi 'admins'
        $this->forge->createTable('admins', TRUE);
    }

    public function down()
    {
        // Mengubah nama tabel yang akan dihapus dari 'users' menjadi 'admins'
        $this->forge->dropTable('admins');
    }
}