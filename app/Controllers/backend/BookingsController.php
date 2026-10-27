<?php

namespace App\Controllers\backend;

use CodeIgniter\Controller;
use App\Models\backend\BookingsModel;

class BookingsController extends Controller
{
    public $email;
    public $session;
    public $BookingsModel;
    public function __construct()
    {
        helper('form');
        helper(['form']);
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
        $this->BookingsModel = new BookingsModel();
    }

    public function manage_bookings()
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . 'logout');
        }

        $data['pageName'] = 'Manage Bookings';
        $data['getAllBookingDetails'] = $this->BookingsModel->getAllBookingDetails();

        foreach ($data['getAllBookingDetails'] as &$book) {

            // Fetch all rooms in this booking
            $rooms = $this->BookingsModel->getRoomsByBooking($book->booking_id);

            $total_amount = 0;
            $total_paid   = 0;

            foreach ($rooms as $room) {

                // Calculate amount for each room
                $checkIn  = strtotime($book->check_in);
                $checkOut = strtotime($book->check_out);
                $days = max(1, ($checkOut - $checkIn) / 86400);

                $room_price = $days * $room['price_per_night'];
                $total_amount += $room_price;

                // Get PAID only for this room
                $paid = $this->BookingsModel->getTotalPaid(
                    $book->booking_id,
                    $room['roomtype_sno'],
                    $room['room_no']
                );

                $total_paid += $paid;
            }

            // Summary assign
            $book->total_amount = $total_amount;
            $book->paid_amount  = $total_paid;
            $book->balance      = $total_amount - $total_paid;
            if ($book->balance < 0) $book->balance = 0;

            // Invoice
            $book->invoice = $this->BookingsModel->getInvoiceByBookingId($book->booking_id);
        }

        echo view('backend/includes/header.php', $data);
        echo view('backend/Bookings/manage-bookings.php', $data);
        echo view('backend/includes/footer.php');
    }

    public function view_bookings($id)
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . 'logout');
        }
        $data['pageName'] = 'Manage Bookings';
        $data['getBookingDetailsById'] = $this->BookingsModel->getBookingDetailsById($id);
        $data['getBookingRoomDetailsById'] = $this->BookingsModel->getBookingRoomDetailsById($id);
        echo view('backend/includes/header.php', $data);
        echo view('backend/Bookings/view-bookings.php', $data);
        echo view('backend/includes/footer.php');
    }

    public function delete_bookings($id1, $id2)
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . 'logout');
        }
        $sessionId = session()->get('logged_user');
        $deleteBookingByIdStatus = $this->BookingsModel->deleteBookingByIdStatus($id1, $id2);
        if ($deleteBookingByIdStatus) {
            return redirect()->to(base_url() . 'manage-bookings');
        } else {
            return redirect()->to(base_url() . 'manage-bookings');
        }
    }

    public function add_bookings()
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . 'logout');
        }
        $sessionId = session()->get('logged_user');
        $data = [];
        $data['pageName'] = 'Add Bookings';
        $data['validation'] = null;
        $data['getAllRoomTypeDetails'] = $this->BookingsModel->getAllRoomTypeDetails();
        $data['getBookingLastRowDetails'] = $this->BookingsModel->getBookingLastRowDetails();
        $data['getAllRooms'] = $this->BookingsModel->getAllRoomNumbers();
        if ($this->request->getMethod() == 'post') {
            $name = $this->request->getVar('name');
            $mobile = $this->request->getVar('mobile');
            $email = $this->request->getVar('email');
            $address = $this->request->getVar('address');
            $no_of_rooms = $this->request->getVar('no_of_rooms');
            $check_in = $this->request->getVar('check_in');
            $check_out = $this->request->getVar('check_out');
            $no_of_adults = $this->request->getVar('no_of_adults');
            $no_of_children = $this->request->getVar('no_of_children');
            $booking_source = $this->request->getVar('booking_source');
            $booking_status = $this->request->getVar('booking_status');
            $booking_date = $this->request->getVar('booking_date');
            $room_type = $this->request->getVar('room_type');
            $room_number = $this->request->getVar('room_number');
            $aadhar = $this->request->getFile('aadhar');
            $newAadhar = null;
            if (empty($aadhar) || $aadhar == '') {
                $newAadhar = null;
            } else {
                if ($aadhar->isValid() && !$aadhar->hasMoved()) {
                    $newAadhar = $aadhar->getRandomName();
                    $aadhar->move('./utilities/backend/GuestAadhar', $newAadhar);
                }
            }
            $rules = [
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Name is Required'
                    ],
                ],
                'mobile' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mobile Number is Required'
                    ],
                ],
                'no_of_rooms' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Rooms Count is Required'
                    ],
                ],
                'check_in' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Check In is Required'
                    ],
                ],
                'check_out' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Check Out Date is Required'
                    ],
                ],
                'address' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Address is Required'
                    ],
                ],
                'no_of_adults' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Adults Count is Required'
                    ],
                ],
                'booking_source' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Booking Source is Required'
                    ],
                ],
                'booking_status' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Booking Status is Required'
                    ],
                ],
                'booking_date' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Booking Date is Required'
                    ],
                ],
            ];
            if ($this->validate($rules)) {
                $bookingId = $data['getBookingLastRowDetails']['booking_id'] ?? null;

                if (empty($bookingId)) {

                    $new_booking_id = 'B-' . date('y') . '-00001';
                } else {

                    $lastNumber = substr($bookingId, -5);

                    $newSerialNo = (int) $lastNumber + 1;

                    $new_booking_id = 'B-' . date('y') . '-' . str_pad($newSerialNo, 5, '0', STR_PAD_LEFT);
                }
                $addInfo = [
                    'booking_id' => $new_booking_id,
                    'name' => $name,
                    'mobile' => $mobile,
                    'email' => $email,
                    'address' => $address,
                    'no_of_rooms' => $no_of_rooms,
                    'check_in' => $check_in,
                    'check_out' => $check_out,
                    'no_of_adults' => $no_of_adults,
                    'no_of_children' => $no_of_children,
                    'booking_source' => $booking_source,
                    'booking_status' => $booking_status,
                    'booking_date' => $booking_date,
                    'aadhar' => $newAadhar,
                    'status' => 1,
                    'created_by' => $sessionId,
                    'created_on' => date('Y-m-d H:i:s'),
                ];
                $insertIntoBookings = $this->BookingsModel->insertIntoBookings($addInfo);
                if ($insertIntoBookings) {
                    if (!empty($room_type) && is_array($room_type)) {

                        foreach ($room_type as $key => $roomType) {

                            if (empty($roomType) || empty($room_number[$key])) {
                                continue;
                            }

                            $roomData = [
                                'booking_sno' => $insertIntoBookings,
                                'booking_id'  => $new_booking_id,
                                'roomtype'   => $roomType,
                                'room_no' => $room_number[$key],
                                'check_in'    => $check_in,
                                'check_out'   => $check_out,
                                'status'      => 1,
                                'created_on'  => date('Y-m-d H:i:s'),
                            ];

                            $this->BookingsModel->insertIntoBookingRoomDetails($roomData);
                        }
                    }
                    return redirect()->to(base_url() . 'manage-bookings');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        echo view('backend/includes/header.php', $data);
        echo view('backend/Bookings/add-bookings.php', $data);
        echo view('backend/includes/footer.php');
    }
    public function edit_bookings($id)
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . 'logout');
        }
        $sessionId = session()->get('logged_user');
        $data = [];
        $data['pageName'] = 'Manage Bookings';
        $data['validation'] = null;
        $data['getAllRoomTypeDetails'] = $this->BookingsModel->getAllRoomTypeDetails();
        $data['getBookingDetailsById'] = $this->BookingsModel->getBookingDetailsById($id);
        $data['getBookingLastRowDetails'] = $this->BookingsModel->getBookingLastRowDetails();
        $data['getBookingRoomDetailsById'] = $this->BookingsModel->getBookingRoomDetailsById($id);
        $data['getAllRooms'] = $this->BookingsModel->getAllRoomNumbers();
        if ($this->request->getMethod() == 'post') {
            $name = $this->request->getVar('name');
            $mobile = $this->request->getVar('mobile');
            $email = $this->request->getVar('email');
            $address = $this->request->getVar('address');
            $no_of_rooms = $this->request->getVar('no_of_rooms');
            $check_in = $this->request->getVar('check_in');
            $check_out = $this->request->getVar('check_out');
            $no_of_adults = $this->request->getVar('no_of_adults');
            $no_of_children = $this->request->getVar('no_of_children');
            $booking_source = $this->request->getVar('booking_source');
            $booking_status = $this->request->getVar('booking_status');
            $booking_date = $this->request->getVar('booking_date');
            $room_type = $this->request->getVar('room_type');
            $room_number = $this->request->getVar('room_number');
            $aadhar = $this->request->getFile('aadhar');
            $newAadhar = null;
            if (!$aadhar || !$aadhar->isValid()) {
                $newAadhar = $data['getBookingDetailsById']['aadhar'];
            } else {
                if ($aadhar->isValid() && !$aadhar->hasMoved()) {
                    $newAadhar = $aadhar->getRandomName();
                    $aadhar->move('./utilities/backend/GuestAadhar', $newAadhar);
                }
            }
            $rules = [
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Name is Required'
                    ],
                ],
                'mobile' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mobile Number is Required'
                    ],
                ],
                'no_of_rooms' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Rooms Count is Required'
                    ],
                ],
                'check_in' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Check In is Required'
                    ],
                ],
                'check_out' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Check Out Date is Required'
                    ],
                ],
                'address' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Address is Required'
                    ],
                ],
                'no_of_adults' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Adults Count is Required'
                    ],
                ],
                'booking_source' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Booking Source is Required'
                    ],
                ],
                'booking_status' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Booking Status is Required'
                    ],
                ],
                'booking_date' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Booking Date is Required'
                    ],
                ],
            ];
            if ($this->validate($rules)) {
                $addInfo = [
                    'name' => $name,
                    'mobile' => $mobile,
                    'email' => $email,
                    'address' => $address,
                    'no_of_rooms' => $no_of_rooms,
                    'check_in' => $check_in,
                    'check_out' => $check_out,
                    'no_of_adults' => $no_of_adults,
                    'no_of_children' => $no_of_children,
                    'booking_source' => $booking_source,
                    'booking_status' => $booking_status,
                    'booking_date' => $booking_date,
                    'aadhar' => $newAadhar,
                    'status' => 1,
                    'updated_by' => $sessionId,
                    'updated_on' => date('Y-m-d H:i:s'),
                ];
                $updateIntoBookings = $this->BookingsModel->updateIntoBookings($id, $addInfo);
                if ($updateIntoBookings) {
                    $this->BookingsModel->deleteBookingRooms($id);

                    if (!empty($room_type) && is_array($room_type)) {

                        foreach ($room_type as $key => $roomType) {

                            if (empty($roomType) || empty($room_number[$key])) {
                                continue;
                            }

                            $roomData = [
                                'booking_sno' => $id,
                                'booking_id'  => $data['getBookingDetailsById']['booking_id'],
                                'roomtype'    => $roomType,
                                'room_no'     => $room_number[$key],
                                'check_in'    => $check_in,
                                'check_out'   => $check_out,
                                'status'      => 1,
                                'created_on'  => date('Y-m-d H:i:s'),
                            ];

                            $this->BookingsModel->insertIntoBookingRoomDetails($roomData);
                        }
                    }
                    return redirect()->to(base_url() . 'manage-bookings');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        echo view('backend/includes/header.php', $data);
        echo view('backend/Bookings/edit-bookings.php', $data);
        echo view('backend/includes/footer.php');
    }
    public function add_invoice()
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . 'logout');
        }

        $session_Id = session()->get('logged_user');

        if ($this->request->getMethod() == 'post') {

            $booking_id     = $this->request->getVar('booking_id');
            $invoice_date   = $this->request->getVar('invoice_date');
            $sub_total      = $this->request->getVar('sub_total');
            $tax_amount     = $this->request->getVar('tax_amount');
            $invoice_status = $this->request->getVar('invoice_status');
            $status         = ($invoice_status == 'open') ? 1 : 0;

            $data = [
                'booking_id'   => $booking_id,
                'invoice_date' => $invoice_date,
                'sub_total'    => $sub_total,
                'tax_amount'   => $tax_amount,
                'status'       => $status,
                'updated_on'   => date('Y-m-d H:i:s'),
                'updated_by'   => $session_Id
            ];
            $existingInvoice = $this->BookingsModel->getInvoiceByBookingId($booking_id);

            if ($existingInvoice) {
                $result = $this->BookingsModel->updateInvoice($booking_id, $data);
                $msg = 'Invoice updated successfully';
            } else {
                $data['created_on'] = date('Y-m-d H:i:s');
                $data['created_by'] = $session_Id;

                $result = $this->BookingsModel->insertInvoice($data);
                $msg = 'Invoice created successfully';
            }

            if ($result) {
                return redirect()->to(base_url('manage-bookings'))->with('success', $msg);
            } else {
                return redirect()->back()->with('error', 'Failed to save invoice');
            }
        }
    }

    public function add_payment()
    {
        $session = session();
        if (!$session->has('logged_user')) {
            return redirect()->to(base_url('logout'));
        }

        if ($this->request->getMethod() !== 'post') {
            return redirect()->back()->with('error', 'Invalid request');
        }

        $booking_id     = $this->request->getPost('booking_id');
        $payment_date   = $this->request->getPost('payment_date');
        $total_amount   = (float)$this->request->getPost('total_amount');
        $payment_amount = (float)$this->request->getPost('payment_amount');
        $payment_method = $this->request->getPost('payment_method');
        $payment_type   = $this->request->getPost('payment_type');
        $roomtype_sno = $this->request->getPost('roomtype_sno');
        $room_no      = $this->request->getPost('room_no');
        $extra_charges = $this->BookingsModel->getTotalExtra($booking_id, $roomtype_sno, $room_no);
        // Get previous paid
        $previous_paid = $this->BookingsModel->getTotalPaid($booking_id, $roomtype_sno, $room_no);

        $paid_amount   = $previous_paid + $payment_amount;   // correct total for that room only
        $balance       = $total_amount - $paid_amount;

        // Safety check
        if ($balance < 0) {
            return redirect()->back()->with('error', 'Payment exceeds total amount');
        }

        // File upload
        $reference_file = $this->request->getFile('reference_file');
        $new_file_name  = null;
        if ($reference_file && $reference_file->isValid() && !$reference_file->hasMoved()) {
            $new_file_name = $reference_file->getRandomName();
            $reference_file->move('./utilities/backend/BookingReference_files', $new_file_name);
        }

        $data = [
            'booking_id'      => $booking_id,
            'roomtype'        => $roomtype_sno,
            'room_no'         => $room_no,
            'date_of_payment' => $payment_date,
            'total_amount'    => $total_amount,
            'paid_amount'     => $paid_amount,
            'payment_amount'  => $payment_amount,
            'balance'         => $balance,
            'payment_method'  => $payment_method,
            'payment_type'    => $payment_type,
            'reference_file'  => $new_file_name,
            'status'          => 1,
            'created_on'      => date('Y-m-d H:i:s'),
            'created_by'      => $session->get('logged_user')
        ];
        if ($this->BookingsModel->insertPayment($data)) {
            return redirect()->back()->with('success', 'Payment added successfully');
        }

        return redirect()->back()->with('error', 'Failed to add payment');
    }
    public function getRoomPayments($roomtype_sno, $room_no)
    {
        $payments = $this->BookingsModel->getRoomPaidAmount($roomtype_sno, $room_no);

        return $this->response->setJSON([
            'status' => 'success',
            'paid'   => $payments['paid']
        ]);
    }

    public function getBookingRooms($booking_id)
    {
        // Log the booking ID for debugging
        log_message('debug', "Fetching rooms for booking ID: $booking_id");

        $rooms = $this->BookingsModel->getRoomsByBooking($booking_id);
        if (empty($rooms)) {
            // Return JSON with message if no rooms found
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No rooms found for this booking',
                'booking_id' => $booking_id,
                'data' => []
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'booking_id' => $booking_id,
            'data' => $rooms
        ]);
    }

    public function getAllRooms()
    {
        $rooms = $this->BookingsModel->getAllRooms();
        return $this->response->setJSON($rooms);
    }
    public function add_charges()
    {
        $session = session();
        if (!$session->has('logged_user')) {
            return redirect()->to(base_url('logout'));
        }

        if ($this->request->getMethod() !== 'post') {
            return redirect()->back()->with('error', 'Invalid request');
        }

        $booking_id = $this->request->getPost('booking_id');
        $charge_type = $this->request->getPost('charge_type');
        if ($charge_type === 'extra_room') {
            $room_sno = $this->request->getPost('room_id'); // roomtypes.sno
            $room_no  = $this->request->getPost('room_no');

            // Get booking_sno from bookings table
            $bookingSno = $this->BookingsModel->getBookingSnoById($booking_id);
            $insertData = [
                'booking_sno' => $bookingSno,
                'booking_id'  => $booking_id,
                'roomtype'    => $room_sno,  // store sno here
                'room_no'     => $room_no,
                'check_in'    => date('Y-m-d H:i:s'), // optional
                'check_out'   => date('Y-m-d H:i:s'), // optional
                'status'      => 1,
                'created_on'  => date('Y-m-d H:i:s')
            ];

            if ($this->BookingsModel->insertBookingRoom($insertData)) {
                return redirect()->to(base_url('manage-bookings'))
                    ->with('success', 'Extra room added successfully');
            }

            return redirect()->back()->with('error', 'Failed to add extra room');
        }
        if ($charge_type === 'extra_night') {

            $extraNights = (int) $this->request->getPost('quantity'); // number of nights
            $br_id = $this->request->getPost('room_id');
            $room_no = $this->request->getPost('room_no');

            // 1. Get current checkout from bookings
            $booking = $this->BookingsModel->getBookingById($booking_id);

            $oldCheckout = $booking['check_out'];

            // 2. Add extra nights
            $newCheckout = date('Y-m-d H:i:s', strtotime($oldCheckout . " +{$extraNights} days"));

            // 3. Update bookings table
            $this->BookingsModel->updateBookingCheckout($booking_id, $newCheckout);

            // 4. Update booking_room_details table
            $this->BookingsModel->updateRoomCheckout($booking_id, $br_id, $room_no, $newCheckout);
        }

        $br_id = $this->request->getPost('room_id'); // room-specific
        $room_no = $this->request->getPost('room_no'); // room-specific
        $quantity = (float)$this->request->getPost('quantity');
        $price = (float)$this->request->getPost('price');
        $total_price = (float)$this->request->getPost('total_price');
        $chargeData = [
            'booking_id'   => $booking_id,
            'room_type'        => $br_id,
            'charge_type'  => $charge_type,
            'quantity'     => $quantity,
            'price'        => $price,
            'total_amount' => $price * $quantity,
            'total_price' => $total_price,
            'status'       => 1,
            'room_no' => $room_no,
            'created_on'   => date('Y-m-d H:i:s'),
            'created_by'   => $session->get('logged_user')
        ];

        if ($this->BookingsModel->insertExtraCharge($chargeData)) {
            return redirect()->to(base_url('manage-bookings'))
                ->with('success', 'Extra charge added successfully');
        }

        return redirect()->back()->with('error', 'Failed to add extra charge');
    }

    public function checkoutSummary($booking_id)
    {
        $rooms = $this->BookingsModel->getBookingRoomsWithPayment($booking_id);
        return $this->response->setJSON([
            'rooms' => $rooms
        ]);
    }
    public function update_checkout()
    {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        $session = session();
        if (!$session->has('logged_user')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Unauthorized']);
        }

        if ($this->request->getMethod() !== 'post') {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid method']);
        }

        $input = json_decode($this->request->getBody(), true);

        if (empty($input['booking_id']) || empty($input['rooms'])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid data']);
        }

        $booking_id = $input['booking_id'];
        $rooms      = $input['rooms'];
        $db = \Config\Database::connect();

        foreach ($rooms as $room) {

            // 1️⃣ free room
            $db->table('rooms')
                ->where('room_number', $room['room_no'])
                ->update(['status' => 0]);

            // 2️⃣ update booking_room_details
            $db->table('booking_room_details')
                ->where('booking_id', $booking_id)
                ->where('room_no', $room['room_no'])
                ->where('roomtype', $room['roomtype_sno'])
                ->where('status !=', 0)
                ->update([
                    'check_out' => date('Y-m-d'),
                    'status'    => 0
                ]);
        }

        // 3️⃣ update bookings table
        $db->table('bookings')
            ->where('booking_id', $booking_id)
            ->update([
                'check_out'  => date('Y-m-d'),
                'updated_on' => date('Y-m-d H:i:s')
            ]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Checkout Updated'
        ]);
    }

    public function getBillDetails($bookingId)
    {
        $db = \Config\Database::connect();

        // 1️⃣ Get booking info
        $booking = $db->table('bookings')
            ->select('booking_id, check_in, check_out, address, mobile, name')
            ->where('booking_id', $bookingId)
            ->get()
            ->getRowArray();

        if (empty($booking['check_in']) || empty($booking['check_out'])) {
            // fallback to room details if booking check-in/out is null
            $roomDates = $db->table('booking_room_details')
                ->selectMin('check_in', 'first_checkin')
                ->selectMax('check_out', 'last_checkout')
                ->where('booking_id', $bookingId)
                ->get()
                ->getRowArray();

            $booking['check_in'] = $booking['check_in'] ?? $roomDates['first_checkin'];
            $booking['check_out'] = $booking['check_out'] ?? $roomDates['last_checkout'];
        }

        // 2️⃣ Get rooms with correct days calculation
        $rows = $db->query("
        SELECT 
            r.room_number, 
            rt.roomtype AS roomtype, 
            rt.sno AS roomtype_id, 
            rt.price_per_night,
            brd.check_in AS room_checkin, 
            brd.check_out AS room_checkout,
            DATEDIFF(
                IFNULL(brd.check_out, ?), 
                IFNULL(brd.check_in, ?)
            ) AS days
        FROM booking_room_details brd
        JOIN rooms r ON r.room_number = brd.room_no
        JOIN room_types rt ON rt.sno = brd.roomtype
        WHERE brd.booking_id = ?
            ", [$booking['check_out'], $booking['check_in'], $bookingId])->getResultArray();

        $rooms = [];
        foreach ($rows as $row) {
            $days = max(1, (int)$row['days']); // minimum 1 day

            // Latest payment for this room
            $latestPayment = $db->table('payments')
                ->select('paid_amount, total_amount')
                ->where('booking_id', $bookingId)
                ->where('room_no', $row['room_number'])
                ->where('roomtype', $row['roomtype_id'])
                ->orderBy('sno', 'DESC')
                ->get()
                ->getRowArray();

            $rooms[] = [
                'roomtype' => $row['roomtype'],
                'room_no' => $row['room_number'],
                'days' => $days,
                'checkin' => $row['room_checkin'] ?? $booking['check_in'],
                'checkout' => $row['room_checkout'] ?? $booking['check_out'],
                'amount' => $latestPayment['total_amount'] ?? $days * (float)$row['price_per_night'],
                'extra_adult' => 0,
                'extra_child' => 0,
                'extra_night' => 0
            ];
        }

        // 3️⃣ Extra charges
        $extraRows = $db->table('extra_charges')
            ->select('room_no, charge_type, SUM(quantity) as qty, SUM(total_amount) as total')
            ->where('booking_id', $bookingId)
            ->groupBy('room_no, charge_type')
            ->get()
            ->getResultArray();

        foreach ($extraRows as $ex) {
            foreach ($rooms as &$r) {
                if ($r['room_no'] == $ex['room_no']) {
                    if ($ex['charge_type'] == 'extra_adult') {
                        $r['extra_adult'] = (float)$ex['total'];
                        $r['extra_adult_qty'] = (int)$ex['qty'];
                    }
                    if ($ex['charge_type'] == 'extra_child') {
                        $r['extra_child'] = (float)$ex['total'];
                        $r['extra_child_qty'] = (int)$ex['qty'];
                    }
                    if ($ex['charge_type'] == 'extra_night') {
                        $r['extra_night'] = (float)$ex['total'];
                        $r['extra_night_qty'] = (int)$ex['qty'];
                    }
                }
            }
        }

        // 4️⃣ Total paid and GST
        $paid = (float)($db->table('payments')->selectSum('paid_amount')->where('booking_id', $bookingId)->get()->getRow('paid_amount') ?? 0);
        $invoice = $db->table('invoice_details')->select('tax_amount')->where('booking_id', $bookingId)->get()->getRowArray();
        $tax_percentage = $invoice['tax_amount'] ?? 0;

        // 5️⃣ Return JSON
        // 5️⃣ Return JSON with only date (YYYY-MM-DD)
        return $this->response->setJSON([
            'booking_id' => $booking['booking_id'] ?? '',
            'checkin' => !empty($booking['check_in']) ? date('Y-m-d', strtotime($booking['check_in'])) : '',
            'checkout' => !empty($booking['check_out']) ? date('Y-m-d', strtotime($booking['check_out'])) : '',
            'address' => $booking['address'] ?? '',
            'name' => $booking['name'] ?? '',
            'mobile' => $booking['mobile'] ?? '',
            'rooms' => array_map(function ($room) {
                $room['checkin'] = !empty($room['checkin']) ? date('Y-m-d', strtotime($room['checkin'])) : '';
                $room['checkout'] = !empty($room['checkout']) ? date('Y-m-d', strtotime($room['checkout'])) : '';
                return $room;
            }, $rooms),
            'paid' => $paid,
            'tax_percentage' => $tax_percentage,
        ]);
    }
}
