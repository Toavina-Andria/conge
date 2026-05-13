<?php

namespace App\Controllers;

use App\Models\CongeModel;
use App\Models\SoldeModel;

class Employe extends BaseController
{
    public function index()
    {
        if ($redirect = $this->requireRole('employe')) return $redirect;

        $employeId  = $this->employe['id'];

        $soldeModel = new SoldeModel();
        $congeModel = new CongeModel();

        $soldes  = $soldeModel->getSoldesEmploye($employeId);
        $total   = 0;
        foreach ($soldes as $s) {
            if ($s['deductible']) {
                $total += (int) $s['reste'];
            }
        }

        $demandes = $congeModel->getDemandesEmploye($employeId);

        $en_attente = 0;
        $approuvees = 0;
        foreach ($demandes as $d) {
            if ($d['statut'] === 'en_attente') $en_attente++;
            if ($d['statut'] === 'approuvee') $approuvees++;
        }

        return view('employe/dashboard', $this->viewData([
            'solde'      => $total,
            'demandes'   => $demandes,
            'en_attente' => $en_attente,
            'approuvees' => $approuvees,
        ]));
    }
}
