<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Cliente HTTP de Laravel

class WebStudentController extends Controller
{
    // URL base de la API 
    private $apiBase = '/api/students';

    // Mostrar la vista CRUD
    public function index()
    {
        return view('students.crud');
    }
}
