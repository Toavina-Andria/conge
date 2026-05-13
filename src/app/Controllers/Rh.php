<?php

namespace App\Controllers;

use App\Models\CongeModel;
use App\Models\EmployeModel;

class Rh extends BaseController
{
    public function index()
    {
        if ($redirect = $this->requireRole('rh')) return $redirect;

        $congeModel   = new CongeModel();
        $employeModel = new EmployeModel();

        $mois  = date('n');
        $annee = date('Y');

        $absences        = $congeModel->getAbsencesMois($mois, $annee);
        $en_attente      = count($congeModel->getDemandesEnAttente());
        $approuvees_mois = count($absences);
        $nb_employes     = $employeModel->countAll();

        return view('rh/dashboard', $this->viewData([
            'absences'        => $absences,
            'en_attente'      => $en_attente,
            'approuvees_mois' => $approuvees_mois,
            'nb_employes'     => $nb_employes,
        ]));
    }
}
