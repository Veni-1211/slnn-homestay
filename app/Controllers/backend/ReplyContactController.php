<?php

namespace App\Controllers\backend;

use CodeIgniter\Controller;
use App\Models\backend\ReplyContactModel;

class ReplyContactController extends Controller
{
    public $email;
    public $session;
    public $ReplyContactModel;
    public function __construct()
    {
        helper('form');
        helper(['form']);
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
        $this->ReplyContactModel = new ReplyContactModel();
    }

    public function manage_contact_reply()
    {
         if (!session()->has('logged_user')) {
            return redirect()->to(base_url('logout'));
        }

        $session_id = session()->get('logged_user');
        $data['replyContactEnquires'] = $this->ReplyContactModel->replyContactEnquires();
        echo view('backend/includes/header.php');
        echo view('backend/Contact-Reply/manage-contact-reply.php', $data);
        echo view('backend/includes/footer.php');
    }

    public function saveMobileReply()
    {
        if ($this->request->getMethod() === 'post') {

            $contactId = $this->request->getPost('contact_id');
            $reply = $this->request->getPost('reply');

            if (!$contactId || !$reply) {
                return redirect()->back()->with('error', 'Invalid data');
            }

            $data = [
                'contact_id' => $contactId,
                'reply' => $reply,
                'reply_type' => 'mobile',
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->ReplyContactModel->addContactReply($data)) {

                // ✅ update contact status
                $this->ReplyContactModel->updateContactStatus($contactId);

                return redirect()->back()->with('success', 'Reply sent successfully');
            }

            return redirect()->back()->with('error', 'Reply not saved');
        }
    }


    public function saveEmailReply()
    {
        if ($this->request->getMethod() === 'post') {

            $contactId = $this->request->getPost('contact_id');
            $reply = $this->request->getPost('reply');

            if (!$contactId || !$reply) {
                return redirect()->back()->with('error', 'Invalid data');
            }

            // 🔹 Get contact details (email, name)
            $contact = $this->ReplyContactModel->getContactById($contactId);

            if (!$contact) {
                return redirect()->back()->with('error', 'Contact not found');
            }

            // 🔹 Save reply to DB
            $data = [
                'contact_id' => $contactId,
                'reply' => $reply,
                'reply_type' => 'email',
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->ReplyContactModel->addContactReply($data)) {

                // 🔹 Update contact status
                $this->ReplyContactModel->updateContactByEmailStatus($contactId);

                // 🔹 SEND EMAIL
                $this->email->setFrom('noreply@innovationtechtree.com', 'Support Team');
                $this->email->setTo($contact->email);
                $this->email->setSubject('Reply to Your Enquiry');

                                    $this->email->setMessage("
                        <p>Dear <strong>{$contact->name}</strong>,</p>

                        <p>Thank you for reaching out to us. We have reviewed your query and here is our response:</p>

                        <p>{$reply}</p>

                        <p>If you have any further questions or concerns, please do not hesitate to contact us again.</p>

                        <br>
                        <p>Warm regards,<br>
                        Support Team<br>
                        Sri Lakshmi Narayana Nivas Home Stay</p>
                    ");


                if (!$this->email->send()) {
                    return redirect()->back()
                        ->with('error', 'Reply saved, but email not sent');
                }

                return redirect()->back()
                    ->with('success', 'Email reply sent successfully');
            }

            return redirect()->back()->with('error', 'Email reply failed');
        }
    }

    public function filterContactReplies()
    {
        if ($this->request->getMethod() === 'post') {

            $search = trim($this->request->getPost('search'));

            if ($search === '') {
                $results = $this->ReplyContactModel->getAllContacts();
            } else {
                $results = $this->ReplyContactModel->searchContacts($search);
            }

            if (!empty($results)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'data' => $results
                ]);
            }

            return $this->response->setJSON([
                'status' => 'empty',
                'message' => 'No Results Found'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Invalid Request'
        ]);
    }
}
