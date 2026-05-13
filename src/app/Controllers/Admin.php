<?php

namespace App\Controllers;

use App\Models\CongeModel;
use App\Models\DepartementModel;
use App\Models\EmployeModel;

class Admin extends BaseController
{
    public function index(): string
    {
        $congeModel      = new CongeModel();
        $employeModel    = new EmployeModel();
        $departementModel = new DepartementModel();

        $mois  = date('n');
        $annee = date('Y');

        $absences = $congeModel->getAbsencesMois($mois, $annee);

        return view('admin/dashboard', $this->viewData([
            'absences'        => $absences,
            'nb_employes'     => $employeModel->countAll(),
            'nb_departements' => $departementModel->countAll(),
            'en_attente'      => count($congeModel->getDemandesEnAttente()),
            'absences_mois'   => count($absences),
        ]));
    }
}
