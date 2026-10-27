<?php

namespace App\Controllers\backend;

use CodeIgniter\Controller;
use App\Models\backend\AuthenticationModel;

class AuthenticationController extends Controller
{
    public $email;
    public $session;
    public $AuthenticationModel;
    public function __construct()
    {
        helper('form');
        helper(['form']);
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
        $this->AuthenticationModel = new AuthenticationModel();
    }

    public function login()
    {
        $data = [];
        $data['pageName'] = 'Login';
        if ($this->request->getMethod() == 'post') {
            $login = trim($this->request->getVar('login')); // email or mobile
            $password = $this->request->getVar('password');

            $rules = [
                'login' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* Email or Mobile is required',
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* Password is required',
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
                    $validateUser = $this->AuthenticationModel->getUserByEmail($login);
                } else {
                    $validateUser = $this->AuthenticationModel->getUserByMobile($login);
                }

                if ($validateUser) {
                    if (password_verify($password, $validateUser['password'])) {
                        $this->session->set('logged_user', $validateUser['session_id']);
                        return redirect()->to(base_url('dashboard'));
                    } else {
                        $data['error'] = '* Wrong Password.Please Enter Correct Password.';
                    }
                } else {
                    $data['error'] = '* Email doesnot register.Please Contact Admin.';
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('backend/Authentication/login.php', $data);
    }

    public function forgot_password()
    {
        $data = [];
        $data['validation'] = NULL;

        if ($this->request->getMethod() == 'post') {

            $email = trim($this->request->getVar('email'));

            $rules = [
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '* Please enter your email',
                        'valid_email' => '* Please enter valid email',
                    ],
                ],
            ];

            if ($this->validate($rules)) {

                $verifyEmailInLogin = $this->AuthenticationModel->getUserByEmail($email);

                if ($verifyEmailInLogin) {

                    $otp = random_int(111111, 999999);

                    $addInfo = [
                        'otp' => $otp,
                        'session_id' => $verifyEmailInLogin['session_id'],
                        'created_on' => date('Y-m-d H:i:s'),
                    ];

                    $insertDataIntoForgotOtp = $this->AuthenticationModel->insertDataIntoForgotOtp($addInfo);

                    if ($insertDataIntoForgotOtp) {

                        $otp_boxes = '';
                        foreach (str_split($otp) as $digit) {
                            $otp_boxes .= '
                        <span style="
                            display:inline-block;
                            width:40px;
                            height:40px;
                            line-height:40px;
                            font-size:20px;
                            text-align:center;
                            border:2px solid #000;
                            margin:5px;
                            font-weight:bold;
                            background:#f8f9fa;
                            border-radius:5px;">' . $digit . '</span>';
                        }

                        $Name = strtoupper(explode("@", $verifyEmailInLogin['email'])[0]);
                        $from = 'noreply@innovationtechtree.com';
                        $subject = 'Reset Your Password - Sri Lakshmi Narayana Nivas Homestays';

                        $message = '
                    Hi <b>' . $Name . '</b>,<br><br>

                    Greetings from <b>Sri Lakshmi Narayana Nivas Homestays</b> 🌿<br><br>

                    We received a request to reset your password for your
                    <b>SLN Homestays account</b>.<br><br>

                    Please use the One-Time Password (OTP) below to continue:<br><br>

                    <table style="text-align:center;margin:auto;">
                        <tr>
                            <td>' . $otp_boxes . '</td>
                        </tr>
                    </table>

                    <br>This OTP is valid for <b>5 minutes</b> only.<br><br>

                    If you did not request a password reset, kindly ignore this email.
                    Your account remains secure.<br><br>

                    <b>Note:</b> Please do not share this OTP with anyone.<br><br>

                    Warm Regards,<br>
                    <b>Sri Lakshmi Narayana Nivas Homestays Team</b><br>
                    <i>Comfort • Peace • Care</i>';

                        $this->email->setTo($email);
                        $this->email->setFrom($from, 'SLN Homestays');
                        $this->email->setSubject($subject);
                        $this->email->setMessage($message);

                        if ($this->email->send()) {
                            return redirect()->to(
                                base_url('verify-forgot-otp/' . $verifyEmailInLogin['session_id'])
                            );
                        } else {
                            $data['error'] = 'Email not sent. Please contact Admin.';
                        }
                    } else {
                        $data['error'] = 'Something went wrong. Contact Admin.';
                    }
                } else {
                    $data['error'] = 'Your email is not registered with us.';
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        echo view('backend/Authentication/forgot-password.php', $data);
    }

    public function verify_forgot_password($session_id)
    {
        $data = [];
        $data['validation'] = null;

        if ($this->request->getMethod() === 'post') {
            $otp = preg_replace('/\s+/', '', $this->request->getVar('otp'));
            $rules = [
                'otp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* Please enter OTP',
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $otpData = $this->AuthenticationModel->getForgotOtpBySession($session_id);
                if ($otpData) {
                    $createdTime = strtotime($otpData['created_on']);
                    $currentTime = time();
                    $diffMinutes = ($currentTime - $createdTime) / 60;
                    if ($diffMinutes <= 5) {
                        if ($otp == $otpData['otp']) {
                            return redirect()->to(
                                base_url('reset-password/' . $session_id)
                            );
                        } else {
                            $data['error'] = '* Invalid OTP. Please try again.';
                        }
                    } else {
                        $data['error'] = '* OTP expired. Please request again.';
                    }
                } else {
                    $data['error'] = '* Invalid request.';
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('backend/Authentication/verify-forgot-password.php', $data);
    }

    public function reset_password($session_id)
    {
        $data = [];
        $data['validation'] = NULL;

        if ($this->request->getMethod() == 'post') {

            $password = $this->request->getVar('password');
            $confirm_password = $this->request->getVar('confirm_password');

            $rules = [
                'password' => [
                    'rules' => 'required|min_length[6]',
                    'errors' => [
                        'required' => '* Please enter new password',
                        'min_length' => '* Password must be at least 6 characters',
                    ],
                ],
                'confirm_password' => [
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => '* Please confirm password',
                        'matches' => '* Passwords do not match',
                    ],
                ],
            ];

            if ($this->validate($rules)) {
                $verifySession = $this->AuthenticationModel->getUserBySession($session_id);
                if ($verifySession) {
                    $updateData = [
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                    ];
                    $updatePassword = $this->AuthenticationModel->updatePasswordBySession($session_id, $updateData);

                    if ($updatePassword) {
                        $this->AuthenticationModel->deleteForgotOtpBySession($session_id);
                        $this->session->setFlashdata('success', 'Password updated successfully. Please login.');

                        return redirect()->to(base_url('admin'));
                    } else {
                        $data['error'] = 'Unable to update password. Try again.';
                    }
                } else {
                    $data['error'] = 'Invalid or expired reset link.';
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('backend/Authentication/reset-password.php', $data);
    }


    public function change_password()
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url('logout'));
        }

        $session_id = session()->get('logged_user');
        $data['validation'] = null;

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Current password is required'
                    ]
                ]
            ];
            if ($this->validate($rules)) {

                $currentPassword = trim($this->request->getVar('password'));

                $user = $this->AuthenticationModel->getUserBySession($session_id);

                if ($user) {

                    if (password_verify($currentPassword, $user['password'])) {

                        $otp = random_int(111111, 999999);

                        $otpData = [
                            'session_id' => $session_id,
                            'otp' => $otp,
                            'created_on' => date('Y-m-d H:i:s')
                        ];

                        if ($this->AuthenticationModel->insertDataIntoChangePasswordOtp($otpData)) {

                            $this->email->setTo($user['email']);
                            $this->email->setFrom('noreply@innovationtechtree.com', 'SLN Homestays');
                            $this->email->setSubject('OTP for Password Change');
                                $this->email->setMessage("
                                    Dear User,<br><br>

                                    We received a request to change the password for your account.<br><br>

                                    Please use the following One-Time Password (OTP) to verify your identity and proceed with the password change:<br><br>

                                    <b style='font-size:18px;'>$otp</b><br><br>

                                    <b>Important:</b><br>
                                    • This OTP is valid for <b>5 minutes</b> only.<br>
                                    • Do not share this OTP with anyone for security reasons.<br>
                                    • If you did not request a password change, please ignore this email or contact support immediately.<br><br>

                                    Thank you for helping us keep your account secure.<br><br>

                                    Regards,<br>
                                    <b>Your Support Team</b>
                                ");

                            if ($this->email->send()) {
                                return redirect()->to(base_url('verify-change-password-otp/' . $session_id));
                            }

                            $data['error'] = 'OTP email failed';
                        } else {
                            $data['error'] = 'OTP generation failed';
                        }
                    } else {
                        $data['error'] = 'Current password is incorrect';
                    }
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('backend/Authentication/change-password.php', $data);
    }
    public function verify_change_password_otp($session_id)
    {
        $data['validation'] = null;

        if ($this->request->getMethod() == 'post') {
            $otp = preg_replace('/\s+/', '', $this->request->getVar('otp'));
            $rules = [
                'otp' => 'required|numeric|exact_length[6]'
            ];

            if ($this->validate($rules)) {

                $otpData = $this->AuthenticationModel
                    ->getChangePasswordOtpBySession($session_id);

                if ($otpData && $otpData['otp'] == $otp) {

                    return redirect()->to(
                        base_url('password-change/' . $session_id)
                    );
                } else {
                    $data['error'] = 'Invalid OTP';
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('backend/Authentication/verify-change-password-otp.php', $data);
    }


    public function change_password_final($session_id)
    {
        $data['validation'] = null;

        if ($this->request->getMethod() === 'post') {

            $rules = [
                'password' => 'required|min_length[6]',
                'confirm_password' => 'required|matches[password]'
            ];

            if ($this->validate($rules)) {

                $hashPassword = password_hash(
                    $this->request->getVar('password'),
                    PASSWORD_DEFAULT
                );

                if (
                    $this->AuthenticationModel
                    ->updatePasswordBySession($session_id, ['password' => $hashPassword])
                ) {

                    $this->AuthenticationModel
                        ->deleteChangePasswordOtp($session_id);

                    return redirect()->to(base_url('admin'))
                        ->with('success', 'Password changed successfully');
                }

                $data['error'] = 'Password update failed';
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('backend/Authentication/password-change.php', $data);
    }

    public function logout()
    {
        session()->remove('logged_user');
        return redirect()->to(base_url() . 'admin');
    }
}
