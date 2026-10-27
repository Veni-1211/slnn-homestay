<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Welcome extends Controller
{
    public function index()
    {
        echo view('includes/header.php');
        echo view('includes/menu.php');
        echo view('dashboard.php');
        echo view('includes/footer.php');
    }
}

?>