<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DepartementSeeder extends Seeder
{
    public function run(): void
    {
        $departements = [
            [
                'nom'         => 'Informatique',
                'description' => 'Service informatique et développement',
            ],
            [
                'nom'         => 'Ressources Humaines',
                'description' => 'Gestion des ressources humaines',
            ],
        ];

        $this->db->table('departements')->insertBatch($departements);
    }
}
