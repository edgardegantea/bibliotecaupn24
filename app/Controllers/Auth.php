<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginProcess()
    {
        $userModel = new UserModel();
        $usernameOrEmail = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $userModel
            ->groupStart()
                ->where('username', $usernameOrEmail)
                ->orWhere('email', $usernameOrEmail)
            ->groupEnd()
            ->first();

        if ($user && password_verify($password, $user['password'])) {
            
            $sessionData = [
                'user_id' => $user['id'],
                'username' => $user['username'],
                'rol'       => $user['rol'],
                'name'      => $user['name'],
                'email'     => $user['email'],
                'logged_in' => true
            ];
            session()->set($sessionData);


            if ($user['rol'] == "admin") {
                return redirect()->to('/admin');
            }

            if ($user['rol'] == "usuario") {
                return redirect()->to('/usuario');
            }

            
        } else {
            return redirect()->back()->withInput()->with('error', 'Usuario o contraseña incorrecta');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }


    public function dashboard()
    {
        if (session()->has('logged_in')) {

            if (session()->get('rol') == "admin") {
                return view('admin/dashboard');
            }

            if (session()->get('rol') == "usuario") {
                return view('usuario/dashboard');
            }

        } else {
            return redirect()->to('/login');
        }

        
    }



    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }

    public function processForgotPassword()
    {
        $email = $this->request->getVar('email');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'No se encontró ningún usuario con ese correo electrónico.');
        }

        $token = bin2hex(random_bytes(16));
        $tokenExpires = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $userModel->update($user['id'], [
            'reset_token' => $token,
            'reset_token_expires' => $tokenExpires
        ]);

        $email = \Config\Services::email();
        $email->setTo($user['email']);
        $email->setSubject('Restablecer contraseña');
        $email->setMessage("Haga clic en el siguiente enlace para restablecer su contraseña:\n\n" .
            base_url('auth/resetPassword/' . $token));
        $email->send();

        return redirect()->to('/login')->with('success', 'Se ha enviado un correo electrónico con instrucciones para restablecer su contraseña.');
    }

    public function resetPassword($token = null)
    {
        if (!$token) {
            return redirect()->to('/login')->with('error', 'Token inválido.');
        }

        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)->first();

        if (!$user || $user['reset_token_expires'] < date('Y-m-d H:i:s')) {
            return redirect()->to('/login')->with('error', 'Token inválido o expirado.');
        }

        $data['token'] = $token;
        return view('auth/reset_password', $data);
    }


    public function processResetPassword()
    {
        $token = $this->request->getVar('token');
        $password = $this->request->getVar('password');
        $confirmPassword = $this->request->getVar('confirm_password');

        $rules = [
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)->first();

        if (!$user || $user['reset_token_expires'] < date('Y-m-d H:i:s')) {
            return redirect()->to('/login')->with('error', 'Token inválido o expirado.');
        }

        $userModel->update($user['id'], [
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'reset_token' => null,
            'reset_token_expires' => null,
        ]);

        return redirect()->to('/login')->with('success', 'Su contraseña ha sido restablecida con éxito.');
    }



}
