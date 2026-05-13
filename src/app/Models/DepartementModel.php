<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartementModel extends Model
{
    protected $table = 'departements';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'description'];
    protected $useTimestamps = false;

    protected $validationRules = [
        'nom' => 'required|max_length[100]',
    ];

    protected $validationMessages = [
        'nom' => [
            'required'   => 'Le nom du département est requis.',
            'max_length' => 'Le nom ne peut dépasser 100 caractères.',
        ],
    ];
}
