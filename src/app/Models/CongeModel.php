<?php

namespace App\Models;

use CodeIgniter\Model;

class CongeModel extends Model
{
    protected $table = 'conges';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'employe_id', 'type_conge_id', 'date_debut', 'date_fin',
        'nb_jours', 'motif', 'statut', 'commentaire_rh', 'created_at', 'traite_par',
    ];
    protected $useTimestamps = false;
    protected $beforeInsert = ['setCreatedAt'];

    protected $validationRules = [
        'employe_id'    => 'required|integer|is_not_unique[employes.id]',
        'type_conge_id' => 'required|integer|is_not_unique[types_conge.id]',
        'date_debut'    => 'required|valid_date',
        'date_fin'      => 'required|valid_date',
        'motif'         => 'permit_empty',
        'statut'        => 'permit_empty|in_list[en_attente,approuvee,refusee,annulee]',
        'commentaire_rh' => 'permit_empty',
        'traite_par'    => 'permit_empty|integer|is_not_unique[employes.id]',
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
        'date_debut' => [
            'required'   => 'La date de début est requise.',
            'valid_date' => 'Date de début invalide.',
        ],
        'date_fin' => [
            'required'   => 'La date de fin est requise.',
            'valid_date' => 'Date de fin invalide.',
        ],
    ];

    protected function setCreatedAt(array $data): array
    {
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    public function getDemandesEmploye(int $employeId): array
    {
        return $this->select('conges.*, types_conge.libelle')
            ->join('types_conge', 'types_conge.id = conges.type_conge_id')
            ->where('conges.employe_id', $employeId)
            ->orderBy('conges.created_at', 'DESC')
            ->findAll();
    }

    public function getDemandesEnAttente(): array
    {
        return $this->select('conges.*, employes.nom, employes.prenom, employes.departement_id,
                              types_conge.libelle as type_libelle')
            ->join('employes', 'employes.id = conges.employe_id')
            ->join('types_conge', 'types_conge.id = conges.type_conge_id')
            ->where('conges.statut', 'en_attente')
            ->orderBy('conges.created_at', 'ASC')
            ->findAll();
    }

    public function getDemandesParDepartement(int $departementId, ?string $statut = null): array
    {
        $this->select('conges.*, employes.nom, employes.prenom, types_conge.libelle as type_libelle')
            ->join('employes', 'employes.id = conges.employe_id')
            ->join('types_conge', 'types_conge.id = conges.type_conge_id')
            ->where('employes.departement_id', $departementId);

        if ($statut) {
            $this->where('conges.statut', $statut);
        }

        return $this->orderBy('conges.created_at', 'DESC')->findAll();
    }

    public function getDemandesFiltrees(?string $statut = null, ?int $departementId = null): array
    {
        $this->select('conges.*, employes.nom, employes.prenom, employes.departement_id,
                       types_conge.libelle as type_libelle,
                       departements.nom as departement_nom,
                       traite.nom as traite_nom, traite.prenom as traite_prenom')
            ->join('employes', 'employes.id = conges.employe_id')
            ->join('types_conge', 'types_conge.id = conges.type_conge_id')
            ->join('departements', 'departements.id = employes.departement_id', 'left')
            ->join('employes as traite', 'traite.id = conges.traite_par', 'left');

        if ($statut) {
            $this->where('conges.statut', $statut);
        }

        if ($departementId) {
            $this->where('employes.departement_id', $departementId);
        }

        return $this->orderBy('conges.created_at', 'DESC')->findAll();
    }

    public function getAbsencesMois(int $mois, int $annee): array
    {
        return $this->select('conges.*, employes.nom, employes.prenom, employes.departement_id,
                              types_conge.libelle as type_libelle')
            ->join('employes', 'employes.id = conges.employe_id')
            ->join('types_conge', 'types_conge.id = conges.type_conge_id')
            ->where('conges.statut', 'approuvee')
            ->where('MONTH(conges.date_debut)', $mois)
            ->where('YEAR(conges.date_debut)', $annee)
            ->orderBy('conges.date_debut', 'ASC')
            ->findAll();
    }

    public function verifierChevauchement(int $employeId, string $dateDebut, string $dateFin, ?int $excludeId = null): bool
    {
        $this->where('employe_id', $employeId)
            ->groupStart()
                ->where('date_debut <=', $dateFin)
                ->where('date_fin >=', $dateDebut)
            ->groupEnd()
            ->whereIn('statut', ['en_attente', 'approuvee']);

        if ($excludeId) {
            $this->where('id !=', $excludeId);
        }

        return $this->countAllResults() > 0;
    }

    public function getHistoriqueComplet(): array
    {
        return $this->select('conges.*, emp1.nom as employe_nom, emp1.prenom as employe_prenom,
                              emp2.nom as traite_nom, emp2.prenom as traite_prenom,
                              types_conge.libelle as type_libelle,
                              departements.nom as departement_nom')
            ->join('employes as emp1', 'emp1.id = conges.employe_id')
            ->join('employes as emp2', 'emp2.id = conges.traite_par', 'left')
            ->join('types_conge', 'types_conge.id = conges.type_conge_id')
            ->join('departements', 'departements.id = emp1.departement_id', 'left')
            ->orderBy('conges.created_at', 'DESC')
            ->findAll();
    }
}
