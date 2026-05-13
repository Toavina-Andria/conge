<?php

namespace App\Models;

use CodeIgniter\Model;

class SoldeModel extends Model
{
    protected $table = 'soldes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'employe_id', 'type_conge_id', 'annee',
        'jours_attribues', 'jours_pris',
    ];
    protected $useTimestamps = false;

    protected $validationRules = [
        'employe_id'      => 'required|integer|is_not_unique[employes.id]',
        'type_conge_id'   => 'required|integer|is_not_unique[types_conge.id]',
        'annee'           => 'required|integer|exact_length[4]',
        'jours_attribues' => 'required|integer|greater_than_equal_to[0]',
        'jours_pris'      => 'permit_empty|integer|greater_than_equal_to[0]',
    ];

    protected $validationMessages = [
        'employe_id' => [
            'required'      => 'L\'employé est requis.',
            'is_not_unique' => 'L\'employé n\'existe pas.',
        ],
        'type_conge_id' => [
            'required'      => 'Le type de congé est requis.',
            'is_not_unique' => 'Le type de congé n\'existe pas.',
        ],
        'annee' => [
            'required'     => 'L\'année est requise.',
            'exact_length' => 'Année invalide (4 chiffres).',
        ],
        'jours_attribues' => [
            'required'  => 'Le nombre de jours attribués est requis.',
            'integer'   => 'Veuillez entrer un nombre valide.',
        ],
    ];

    public function getSolde(int $employeId, int $typeCongeId, int $annee): array|object|null
    {
        return $this->where('employe_id', $employeId)
            ->where('type_conge_id', $typeCongeId)
            ->where('annee', $annee)
            ->first();
    }

    public function getReste(int $employeId, int $typeCongeId, int $annee): int
    {
        $solde = $this->getSolde($employeId, $typeCongeId, $annee);
        if (!$solde) {
            return 0;
        }

        $joursAttribues = is_array($solde) ? ($solde['jours_attribues'] ?? 0) : ($solde->jours_attribues ?? 0);
        $joursPris = is_array($solde) ? ($solde['jours_pris'] ?? 0) : ($solde->jours_pris ?? 0);

        return (int) $joursAttribues - (int) $joursPris;
    }

    public function deduireJours(int $employeId, int $typeCongeId, int $annee, int $nbJours): bool
    {
        $solde = $this->getSolde($employeId, $typeCongeId, $annee);
        if (!$solde) {
            return false;
        }

        $soldeId = is_array($solde) ? ($solde['id'] ?? null) : ($solde->id ?? null);
        $joursAttribues = is_array($solde) ? ($solde['jours_attribues'] ?? 0) : ($solde->jours_attribues ?? 0);
        $joursPris = is_array($solde) ? ($solde['jours_pris'] ?? 0) : ($solde->jours_pris ?? 0);
        if (!$soldeId) {
            return false;
        }

        $reste = (int) $joursAttribues - (int) $joursPris;
        if ($nbJours > $reste) {
            return false;
        }

        return (bool) $this->builder()
            ->set('jours_pris', 'jours_pris + ' . $nbJours, false)
            ->where('id', $soldeId)
            ->update();
    }

    public function crediterJours(int $employeId, int $typeCongeId, int $annee, int $nbJours): bool
    {
        $solde = $this->getSolde($employeId, $typeCongeId, $annee);
        if (!$solde) {
            return false;
        }

        $soldeId = is_array($solde) ? ($solde['id'] ?? null) : ($solde->id ?? null);
        if (!$soldeId) {
            return false;
        }

        return (bool) $this->builder()
            ->set('jours_pris', 'jours_pris - ' . $nbJours, false)
            ->where('id', $soldeId)
            ->where('jours_pris >=', $nbJours)
            ->update();
    }

    public function getSoldesEmploye(int $employeId): array
    {
        return $this->select('soldes.*, types_conge.libelle, types_conge.jours_annuels, types_conge.deductible,
                              (soldes.jours_attribues - soldes.jours_pris) as reste')
            ->join('types_conge', 'types_conge.id = soldes.type_conge_id')
            ->where('soldes.employe_id', $employeId)
            ->orderBy('soldes.annee', 'DESC')
            ->findAll();
    }
}
