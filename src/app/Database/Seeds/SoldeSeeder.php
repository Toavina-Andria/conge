<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SoldeSeeder extends Seeder
{
    public function run(): void
    {
        // Employés: 1 (admin), 2 (employé), 3 (employé)
        // Types: 1 (CP), 2 (Maladie), 3 (Sans solde)
        $annee = 2026;

        $soldes = [];

        $employes = [1, 2, 3];
        $types = [
            1 => 25,  // Congés payés
            2 => 10,  // Congés maladie
            3 => 0,   // Congés sans solde
        ];

        foreach ($employes as $empId) {
            foreach ($types as $typeId => $jours) {
                $soldes[] = [
                    'employe_id'     => $empId,
                    'type_conge_id'  => $typeId,
                    'annee'          => $annee,
                    'jours_attribues' => $jours,
                    'jours_pris'     => 0,
                ];
            }
        }

        $this->db->table('soldes')->insertBatch($soldes);
    }
}
