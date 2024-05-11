<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register_proses()
    {
        $validationRules = [
            'email' => 'required|min_length[4]|max_length[100]',
            'username' => 'required|min_length[4]|max_length[20]|is_unique[user.username]',
            'password' => 'required|min_length[4]|max_length[50]',
        ];

        $validationMessages = [
            'email' => [
                'required' => 'Email harus diisi.',
                'min_length' => 'Email minimal 4 karakter.',
                'max_length' => 'Email maksimal 100 karakter.'
            ],
            'username' => [
                'required' => 'Username harus diisi.',
                'min_length' => 'Username minimal 4 karakter.',
                'max_length' => 'Username maksimal 20 karakter.',
                'is_unique' => 'Username sudah digunakan sebelumnya.'
            ],
            'password' => [
                'required' => 'Password harus diisi.',
                'min_length' => 'Password minimal 4 karakter.',
                'max_length' => 'Password maksimal 50 karakter.'
            ],
        ];

        $isValid = $this->validate($validationRules, $validationMessages);

        if (!$isValid) {
            return redirect()->to('/register')->withInput()->with('error', 'Validasi gagal.');
        }
        $data = array(
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        );
        $model = new UserModel();
        $model->insert($data);
        session()->setFlashdata('pesan', 'Selamat Anda berhasil Registrasi, Silahkan Login!');
        return redirect()->to('/login');
    }

    public function proses_login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $model = new UserModel();
        $user = $model->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Jika username dan password cocok, set session dan arahkan ke halaman tertentu
                $sessionData = [
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'logged_in' => TRUE
                ];
                session()->set($sessionData);
                return redirect()->to('/'); // Ubah sesuai kebutuhan
            } else {
                session()->setFlashdata('pesan', 'Password yang Anda masukkan salah.');
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('auth', 'Username tidak ditemukan.');
            return redirect()->to('/login');
        }
    }
}
