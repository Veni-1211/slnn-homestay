<?php

namespace App\Controllers\backend;

use CodeIgniter\Controller;
use App\Models\backend\BookingsReplyModel;

class BookingReplyController extends Controller
{
    protected $BookingsReplyModel;
    protected $email;
    protected $session;

    public function __construct()
    {
        helper(['form']);
        $this->session = \Config\Services::session();
        $this->email   = \Config\Services::email();
        $this->BookingsReplyModel = new BookingsReplyModel();
    }

    public function manage_reply_bookings()
    {
         if (!session()->has('logged_user')) {
            return redirect()->to(base_url('logout'));
        }

        $session_id = session()->get('logged_user');
        $bookings = $this->BookingsReplyModel->replyBookingsEnquires();

        $bookingReplies = [];

        if ($bookings) {
            foreach ($bookings as $booking) {
                $bookingReplies[$booking->sno] =
                    $this->BookingsReplyModel->getRepliesByBooking($booking->sno);
            }
        }

        $data = [
            'replyBookingsEnquires' => $bookings,
            'bookingReplies'       => $bookingReplies
        ];

        echo view('backend/includes/header.php');
        echo view('backend/Bookings-reply/manage-reply-bookings.php', $data);
        echo view('backend/includes/footer.php');
    }


    // 🔹 SAVE BOOKING REPLY (POST)
    public function save_booking_reply()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->back();
        }

        $bookingId = $this->request->getPost('booking_id');
        $reply     = $this->request->getPost('reply');

        if (!$bookingId || !$reply) {
            return redirect()->back()->with('error', 'Invalid data');
        }

        $data = [
            'booking_id' => $bookingId,
            'reply'      => $reply,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->BookingsReplyModel->addBookingReply($data)) {

            // ✅ Update booking status
            $this->BookingsReplyModel->updateBookingStatus($bookingId);

            return redirect()->back()->with('success', 'Booking reply sent successfully');
        }

        return redirect()->back()->with('error', 'Reply not saved');
    }
}
