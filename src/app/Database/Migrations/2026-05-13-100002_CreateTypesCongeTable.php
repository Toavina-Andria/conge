<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTypesCongeTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'libelle' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'jours_annuels' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'deductible' => [
                'type'    => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('types_conge');
    }

    public function down(): void
    {
        $this->forge->dropTable('types_conge');
    }
}
