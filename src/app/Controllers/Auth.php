<?php

namespace App\Controllers;

use App\Models\EmployeModel;

class Auth extends BaseController
{
    public function index()
    {
        if ($this->employe) {
            return redirect()->to($this->redirectByRole());
        }

        return view('auth/login', ['employe' => null, 'role' => null]);
    }

    public function login()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $model  = new EmployeModel();
        $employe = $model->where('email', $email)->first();

        if (!$employe || !password_verify($password, $employe['password'])) {
            return redirect()->back()->with('error', 'Email ou mot de passe incorrect.');
        }

        if (!$employe['actif']) {
            return redirect()->back()->with('error', 'Votre compte est désactivé.');
        }

        $this->session->set('employe', [
            'id'             => $employe['id'],
            'nom'            => $employe['nom'],
            'prenom'         => $employe['prenom'],
            'email'          => $employe['email'],
            'role'           => $employe['role'],
            'departement_id' => $employe['departement_id'],
        ]);

        return redirect()->to($this->redirectByRole())
            ->with('success', 'Bienvenue, ' . $employe['prenom'] . ' !');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('login');
    }

    private function redirectByRole(): string
    {
        return match ($this->session->get('employe')['role']) {
            'admin'   => 'admin',
            'rh'      => 'rh',
            default   => 'employe',
        };
    }
}
