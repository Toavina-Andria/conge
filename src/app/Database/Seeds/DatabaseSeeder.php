<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->truncateAllTables();

        $this->call('App\Database\Seeds\DepartementSeeder');
        $this->call('App\Database\Seeds\EmployeSeeder');
        $this->call('App\Database\Seeds\TypeCongeSeeder');
        $this->call('App\Database\Seeds\SoldeSeeder');
    }

    private function truncateAllTables(): void
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $this->db->table('soldes')->truncate();
        $this->db->table('conges')->truncate();
        $this->db->table('types_conge')->truncate();
        $this->db->table('employes')->truncate();
        $this->db->table('departements')->truncate();
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
    }
}
