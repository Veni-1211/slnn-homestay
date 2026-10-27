<?php
namespace App\Controllers\backend;
use CodeIgniter\Controller;
use App\Models\backend\DashboardModel;
class DashboardController extends Controller{
    public $email;
    public $session;
    public $DashboardModel;
    public function __construct()
    {
        helper('form');
        helper(['form']);
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
        $this->DashboardModel = new DashboardModel();

    }

    public function dashboard(){
         if (!session()->has('logged_user')) {
            return redirect()->to(base_url('logout'));
        }

        $session_id = session()->get('logged_user');
        $data['pageName'] = 'Dashboard';
        echo view('backend/includes/header.php', $data);
        echo view('backend/Dashboard/dashboard.php');
        echo view('backend/includes/footer.php');
    }
}
?>