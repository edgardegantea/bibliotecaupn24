<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class NoauthFilter implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->has('logged_in')) {

            if (session()->get('rol') == 'admin') {
                return redirect()->to('/admin/dashboard');
            }

            if (session()->get('rol') == 'usuario') {
                return redirect()->to('/usuario/dashboard');
            }

        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
