<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Instrument; 
use App\Models\InstrumentCounter;
use App\Providers\AuthServiceProvider;

class UserController extends Controller {

    public function login() {
        $user = $_GET['user'];
        $pass = $_GET['pass'];
        if ($user != 'admin' || $pass != 'password') {
            return '
		    <script>
		    	alert("Usuario o contraseña incorrectos");
		    	window.location.replace("http://localhost:8000/");
		    </script>';
        }
        session_start();
        $_SESSION['token'] = AuthServiceProvider::generateBearerToken();
        header('Location: http://localhost:8000/landing');
        exit();
    }

}