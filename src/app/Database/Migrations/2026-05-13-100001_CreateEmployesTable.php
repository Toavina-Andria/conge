<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployesTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nom' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'prenom' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'departement_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'date_embauche' => [
                'type' => 'DATE',
            ],
            'actif' => [
                'type'    => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('departement_id', 'departements', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('employes');
    }

    public function down(): void
    {
        $this->forge->dropTable('employes');
    }
}
