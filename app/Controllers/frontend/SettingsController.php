<?php

namespace App\Controllers\frontend;

use App\Models\frontend\SettingsModel;
use CodeIgniter\Controller;

class SettingsController extends Controller
{
    public $email;
    public $session;
    public $SettingsModel;
    public function __construct()
    {
        helper('form');
        helper(['form']);
        $this->email = \Config\Services::email();
        $this->session = \Config\Services::session();
        $this->SettingsModel = new SettingsModel();
    }
    public function home()
    {
        $data['deluxe'] = $this->SettingsModel->getdetailsByRoomType('Deluxe');
        $data['superDeluxe'] = $this->SettingsModel->getdetailsByRoomType('Super Deluxe');
        $data['superLuxury'] = $this->SettingsModel->getdetailsByRoomType('Super Luxury');
        $data['grandSuite'] = $this->SettingsModel->getdetailsByRoomType('Grand Suite');
        $data['pagename'] = 'home';
        $data['getAllTestimonials'] = $this->SettingsModel->getAllTestimonials();
        echo view('frontend/includes/header.php', $data);
        echo view('frontend/settings/home.php', $data);
        echo view('frontend/includes/footer.php');
    }

    public function about()
    {
        $data['pagename'] = 'about';
        echo view('frontend/includes/header.php', $data);
        echo view('frontend/settings/about.php');
        echo view('frontend/includes/footer.php');
    }
    public function bookings()
    {
        $data['pagename'] = 'bookings';
        
        $data['deluxe'] = $this->SettingsModel->getdetailsByRoomType('Deluxe');
        $data['superDeluxe'] = $this->SettingsModel->getdetailsByRoomType('Super Deluxe');
        $data['superLuxury'] = $this->SettingsModel->getdetailsByRoomType('Super Luxury');
        $data['grandSuite'] = $this->SettingsModel->getdetailsByRoomType('Grand Suite');
        echo view('frontend/includes/header.php', $data);
        echo view('frontend/pages/booking.php');
        echo view('frontend/includes/footer.php');
    }
    public function contact()
    {
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $name = $this->request->getVar('name');
            $useremail = $this->request->getVar('email');
            $mobile = $this->request->getVar('mobile');
            $subject = $this->request->getVar('subject');
            $message = $this->request->getvar('message');
            $addInfo = [
                'name' => $name,
                'email' => $useremail,
                'mobile' => $mobile,
                'subject' => $subject,
                'message' => $message,
                'created_on' => date('Y-m-d H:i:s'),
                'status' => 0,
            ];
            $insertIntoContact = $this->SettingsModel->insertIntoContact($addInfo);
            if ($insertIntoContact) {
                $this->email->setTo('contactus@srilakshminarayananivashomestay.com');
                $this->email->setFrom('contactus@srilakshminarayananivashomestay.com', 'noreply');
                $this->email->setSubject('New Contact Enquiry');
                $this->email->setMessage('
                    <div style="font-family: Arial, Helvetica, sans-serif; background-color:#ffffff; color:#333333; padding:20px;">

                        <p style="font-size:18px; font-weight:bold; color:#0d6efd; margin-bottom:15px;">
                            New Contact Enquiry Received
                        </p>

                        <p style="font-size:16px; margin-bottom:15px;">
                            Dear Team,
                        </p>

                        <p style="font-size:16px; line-height:1.7; margin-bottom:20px;">
                            You have received a new enquiry from the contact form on your website.
                            Please find the details below.
                        </p>

                        <p style="font-size:16px; margin-bottom:10px;">
                            <strong>Name:</strong> ' . $name . '
                        </p>

                        <p style="font-size:16px; margin-bottom:10px;">
                            <strong>Email:</strong> ' . $useremail . '
                        </p>
                         <p style="font-size:16px; margin-bottom:10px;">
                            <strong>Mobile No:</strong> ' . $mobile . '
                        </p>
                        <p style="font-size:16px; margin-bottom:10px;">
                            <strong>Subject:</strong> ' . $subject . '
                        </p>

                        <p style="font-size:16px; margin-bottom:5px;">
                            <strong>Message:</strong>
                        </p>

                        <p style="font-size:16px; line-height:1.7; background-color:#f5f5f5; padding:12px; border-left:4px solid #0d6efd; white-space:pre-line;">
                            ' . $message . '
                        </p>

                        <p style="font-size:15px; margin-top:20px;">
                            <strong>Submitted On:</strong> ' . date("d-m-Y h:i:s A") . '
                        </p>

                        <p style="font-size:15px; color:#555555;">
                            This enquiry was submitted through your official website contact form.
                        </p>

                       

                    </div>
                    ');

                if ($this->email->send()) {
                    $data['success'] = 'Your request has been submitted successfully.';
                    return redirect()->to(current_url());
                } else {
                    $data['error'] = 'Your request could not be submitted. Please try again.';
                }
            }
        }
        $data['pagename'] = 'contact';
        echo view('frontend/includes/header.php', $data);
        echo view('frontend/settings/contact.php', $data);
        echo view('frontend/includes/footer.php');
    }
    public function bookings_byCustomer()
    {
        if ($this->request->getMethod() == 'post') {
            $data = [
                'check_in'  => $this->request->getPost('checkin'),
                'check_out' => $this->request->getPost('checkout'),
                'name'          => $this->request->getPost('name'),
                'email'         => $this->request->getPost('email'),
                'mobile_no'        => $this->request->getPost('mobile'),
                'room_type'     => $this->request->getPost('roomType'),
                'created_on'    => date('Y-m-d H:i:s'),
                'status' => 1,
            ];
            $this->SettingsModel->insertBooking($data);
        }
        return redirect()->back()->with('success', 'Booking submitted successfully');
    }
}
