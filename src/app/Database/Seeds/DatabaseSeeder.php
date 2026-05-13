<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call('App\Database\Seeds\DepartementSeeder');
        $this->call('App\Database\Seeds\EmployeSeeder');
        $this->call('App\Database\Seeds\TypeCongeSeeder');
        $this->call('App\Database\Seeds\SoldeSeeder');
    }
}
