<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGamesTable extends Migration
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
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'embed_url' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'cover_url' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'how_to_play' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default'    => 'active',
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
        $this->forge->createTable('games');
    }

    public function down()
    {
        $this->forge->dropTable('games');
    }
}