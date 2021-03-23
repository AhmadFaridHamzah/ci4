<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Upload extends Migration
{
	public function up()
	{
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'file_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'file_ext' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'upload_path' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('upload');
	}

	public function down()
	{
        $this->forge->dropTable('upload');
	}
}
