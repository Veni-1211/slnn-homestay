<?php
namespace App\Controllers\backend;
use CodeIgniter\Controller;
use App\Models\backend\RoomsAvailabilityModel;
class RoomsAvailabilityController extends Controller
{
    public $email;
    public $session;
    public $RoomsAvailabilityModel;
    public function __construct()
    {
        helper('form');
        helper(['form']);
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
        $this->RoomsAvailabilityModel = new RoomsAvailabilityModel();

    }
     public function rooms_availability()
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url('logout'));
        }
        $model = new RoomsAvailabilityModel();

        // Default date = today
        $date = $this->request->getGet('date') ?? date('Y-m-d');

        // Safety: do not allow past dates
        if ($date < date('Y-m-d')) {
            $date = date('Y-m-d');
        }

        $data = [
            'date'  => $date,
            'rooms' => $model->getRoomsAvailability($date)
        ];

        echo view('backend/includes/header');
        echo view('backend/Availability/rooms-availability', $data);
        echo view('backend/includes/footer');
    }


}
?>