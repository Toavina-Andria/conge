<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TypeCongeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'libelle'       => 'Congés payés',
                'jours_annuels' => 25,
                'deductible'    => 1,
            ],
            [
                'libelle'       => 'Congés maladie',
                'jours_annuels' => 10,
                'deductible'    => 1,
            ],
            [
                'libelle'       => 'Congés sans solde',
                'jours_annuels' => 0,
                'deductible'    => 0,
            ],
        ];

        $this->db->table('types_conge')->insertBatch($types);
    }
}
