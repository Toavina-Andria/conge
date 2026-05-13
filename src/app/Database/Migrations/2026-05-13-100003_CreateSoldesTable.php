<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSoldesTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'employe_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'type_conge_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'annee' => [
                'type' => 'YEAR',
            ],
            'jours_attribues' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'jours_pris' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 0,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('employe_id', 'employes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('type_conge_id', 'types_conge', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('soldes');
    }

    public function down(): void
    {
        $this->forge->dropTable('soldes');
    }
}
