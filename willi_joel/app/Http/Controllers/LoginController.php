<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Employee;
use App\Models\DeptEmp;
class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('employees.login');
    }
    public function login(Request $request)
    {
        // Validar entrada
        $credentials = $request->validate([
            'user' => 'required',
            'password' => 'required'
        ], [
            'user.required' => 'Debe introducir su número de empleado.',
            'password.required' => 'Debe introducir su contraseña.',
        ]);

        // Buscar usuario en la base de datos
        $user = Employee::where('emp_no', $credentials['user'])->first();
        if ($user && $user->last_name === $credentials['password']) {
            // Obtener el departamento del usuario
            $dept = DeptEmp::where('emp_no', $user->emp_no)->value('dept_no');
            // Crear cookies
            Cookie::queue('USERPASS', $user->emp_no, 60);
            Cookie::queue('NAME', $user->first_name . " " . $user->last_name, 60);
            Cookie::queue('DEPT', $dept, 60);
            // Redirigir según el departamento
            if ($dept === 'd003') {
                return redirect()->route('welcome_rrhh');
            } else {
                return redirect()->route('welcome_employees');
            }
        } else {
            return back()->withErrors(['login' => 'ERROR DE INICIO SESIÓN']);
        }
    }

    public function logout()
    {
        Cookie::queue(Cookie::forget('USERPASS'));
        Cookie::queue(Cookie::forget('NAME'));
        Cookie::queue(Cookie::forget('DEPT'));
        return redirect()->route('login.form');
    }
}
