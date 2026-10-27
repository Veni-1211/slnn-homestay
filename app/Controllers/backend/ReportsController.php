<?php

namespace App\Controllers\backend;

use CodeIgniter\Controller;
use App\Models\backend\ReportsModel;

class ReportsController extends Controller
{
    public $email;
    public $session;
    public $ReportsModel;
    public function __construct()
    {
        helper('form');
        helper(['form']);
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
        $this->ReportsModel = new ReportsModel();
    }

    public function reports()
    {
         if (!session()->has('logged_user')) {
            return redirect()->to(base_url('logout'));
        }

        $session_id = session()->get('logged_user');
        $data['pageName'] = 'Reports';
        $data['getAllBookingDetails'] = $this->ReportsModel->getAllBookingDetails();
        echo view('backend/includes/header.php', $data);
        echo view('backend/Reports/reports.php', $data);
        echo view('backend/includes/footer.php');
    }

    public function manage_testimonials()
    {
         if (!session()->has('logged_user')) {
            return redirect()->to(base_url('logout'));
        }

        $session_id = session()->get('logged_user');
        $data['pageName'] = 'Manage Testimonials';
        $data['getAllTestimonials'] = $this->ReportsModel->getAllTestimonials();
        echo view('backend/includes/header.php', $data);
        echo view('backend/Reports/manage-testimonials.php', $data);
        echo view('backend/includes/footer.php');
    }

    public function add_testimonials()
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . 'logout');
        }
        $sessionId = session()->get('logged_user');
        $data['pageName'] = 'Add Testimonials';
        $data['validation'] = null;
        if ($this->request->getMethod() == 'post') {
            $name = $this->request->getVar('name');
            $feedback = $this->request->getVar('feedback');
            $ratings = $this->request->getVar('ratings');
            $rules = [
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Name Required',
                    ],
                ],
                'ratings' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Ratings Required',
                    ],
                ],
                'feedback' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Feedback Required',
                    ],
                ],
            ];
            if ($this->validate($rules)) {
                $addInfo = [
                    'name' => $name,
                    'feedback' => $feedback,
                    'ratings' => $ratings,
                    'status' => 1,
                    'created_by' => $sessionId,
                    'created_on' => date('Y-m-d H:i:s'),
                ];
                $insertIntoTestimonials = $this->ReportsModel->insertIntoTestimonials($addInfo);
                if ($insertIntoTestimonials) {
                    return redirect()->to(base_url() . 'manage-testimonials');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        echo view('backend/includes/header.php', $data);
        echo view('backend/Reports/add-testimonials.php', $data);
        echo view('backend/includes/footer.php');
    }

    public function edit_testimonials($id)
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . 'logout');
        }
        $sessionId = session()->get('logged_user');
        $data['pageName'] = 'Manage Testimonials';
        $data['validation'] = null;
        $data['getAllTestimonialDetailsById'] = $this->ReportsModel->getAllTestimonialDetailsById($id);
        if ($this->request->getMethod() == 'post') {
            $name = $this->request->getVar('name');
            $feedback = $this->request->getVar('feedback');
            $ratings = $this->request->getVar('ratings');
            $rules = [
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Name Required',
                    ],
                ],
                'ratings' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Ratings Required',
                    ],
                ],
                'feedback' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Feedback Required',
                    ],
                ],
            ];
            if ($this->validate($rules)) {
                $addInfo = [
                    'name' => $name,
                    'feedback' => $feedback,
                    'ratings' => $ratings,
                    'status' => 1,
                    'updated_by' => $sessionId,
                    'updated_on' => date('Y-m-d H:i:s'),
                ];
                $updateIntoTestimonials = $this->ReportsModel->updateIntoTestimonials($id, $addInfo);
                if ($updateIntoTestimonials) {
                    return redirect()->to(base_url() . 'manage-testimonials');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        echo view('backend/includes/header.php', $data);
        echo view('backend/Reports/edit-testimonials.php', $data);
        echo view('backend/includes/footer.php');
    }

    public function view_testimonials($id)
    {
         if (!session()->has('logged_user')) {
            return redirect()->to(base_url('logout'));
        }

        $session_id = session()->get('logged_user');
        $data['pageName'] = 'Manage Testimonials';
        $data['getAllTestimonialDetailsById'] = $this->ReportsModel->getAllTestimonialDetailsById($id);
        echo view('backend/includes/header.php', $data);
        echo view('backend/Reports/view-testimonials.php', $data);
        echo view('backend/includes/footer.php');
    }

    public function delete_testimonials($id, $status)
    {
        $delete = $this->ReportsModel->deleteTestimonialByIdStatus($id, $status);
        if ($delete) {
            return redirect()->to(base_url() . 'manage-testimonials');
        } else {
            return redirect()->to(base_url() . 'manage-testimonials');
        }
    }
}
