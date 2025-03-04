<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function showWelcomeRRHH()
    {
        return view('employees.welcome_rrhh');
    }

    public function showWelcomeEMP()
    {
        return view('employees.welcome_employees');
    }
}
