<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeCongeModel extends Model
{
    protected $table = 'types_conge';
    protected $primaryKey = 'id';
    protected $allowedFields = ['libelle', 'jours_annuels', 'deductible'];
    protected $useTimestamps = false;

    protected $validationRules = [
        'libelle'       => 'required|max_length[100]',
        'jours_annuels' => 'required|integer|greater_than[0]',
        'deductible'    => 'permit_empty|in_list[0,1]',
    ];

    protected $validationMessages = [
        'libelle' => [
            'required'   => 'Le libellé est requis.',
            'max_length' => 'Le libellé ne peut dépasser 100 caractères.',
        ],
        'jours_annuels' => [
            'required'    => 'Le nombre de jours annuels est requis.',
            'integer'     => 'Veuillez entrer un nombre valide.',
            'greater_than' => 'Le nombre doit être supérieur à 0.',
        ],
    ];
}
