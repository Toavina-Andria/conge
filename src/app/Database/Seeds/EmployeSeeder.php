<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmployeSeeder extends Seeder
{
    public function run(): void
    {
        $employes = [
            [
                'nom'             => 'Dupont',
                'prenom'          => 'Marc',
                'email'           => 'marc.dupont@company.com',
                'password'        => password_hash('admin123', PASSWORD_DEFAULT),
                'role'            => 'admin',
                'departement_id'  => 1,
                'date_embauche'   => '2020-01-15',
                'actif'           => 1,
            ],
            [
                'nom'             => 'Martin',
                'prenom'          => 'Sophie',
                'email'           => 'sophie.martin@company.com',
                'password'        => password_hash('employe123', PASSWORD_DEFAULT),
                'role'            => 'employe',
                'departement_id'  => 1,
                'date_embauche'   => '2022-03-01',
                'actif'           => 1,
            ],
            [
                'nom'             => 'Leroy',
                'prenom'          => 'Julie',
                'email'           => 'julie.leroy@company.com',
                'password'        => password_hash('employe123', PASSWORD_DEFAULT),
                'role'            => 'employe',
                'departement_id'  => 2,
                'date_embauche'   => '2023-06-15',
                'actif'           => 1,
            ],
        ];

        $this->db->table('employes')
            ->ignore(true)
            ->insertBatch($employes);
    }
}
