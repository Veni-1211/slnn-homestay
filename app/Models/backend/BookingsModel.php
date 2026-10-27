<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class BookingsModel extends Model
{
    public function getAllBookingDetails()
    {
        $builder = $this->db->table('bookings');
        $query = $builder->get();
        return $query->getResult();
    }
    
    public function updateInvoice($booking_id, $data)
    {
        return $this->db->table('invoice_details')
            ->where('booking_id', $booking_id)
            ->update($data);
    }

    public function getBookingLastRowDetails()
    {
        $builder = $this->db->table('bookings');
        $builder->orderBy('sno', 'Desc')->limit(1);
        $query = $builder->get();
        return $query->getRowArray();
    }
    
    public function getAllRoomNumbers()
    {
        $builder = $this->db->table('rooms');
        $builder->select('*');
        $builder->where('status', 1);
        $query = $builder->get();
        return $query->getResult(); // returns as objects
    }

    public function getBookingDetailsById($id)
    {
        $builder = $this->db->table('bookings');
        $builder->where('sno', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function deleteBookingByIdStatus($id, $status)
    {
        $builder = $this->db->table('bookings');
        $builder->where('sno', $id);
        if ($status == 1) {
            return  $builder->update(['status' => 0]);
        }
        if ($status == 0) {
            return $builder->update(['status' => 1]);
        }
    }

    public function insertIntoBookings($data)
    {
        $builder = $this->db->table('bookings');
        $builder->insert($data);
        return $this->db->insertID();
    }

    public function updateIntoRoomType($id, $data)
    {
        $builder = $this->db->table('room_types');
        $query = $builder->where('sno', $id)->update($data);
        return $query;
    }
    public function insertIntoBookingRoomDetails($data)
    {
        $builder = $this->db->table('booking_room_details');
        $query = $builder->insert($data);
        return $query;
    }
    public function getBookingRoomDetailsById($id)
    {
        return $this->db->table('booking_room_details brd')
            ->select('
            brd.roomtype AS roomtype_id,
            brd.room_no
        ')
            ->where('brd.booking_sno', $id)
            ->get()
            ->getResultArray();
    }
    public function getRoomTypeDetailsById($id)
    {
        $builder = $this->db->table('room_types');
        $builder->where('sno', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function updateIntoBookings($id, $data)
    {
        $builder = $this->db->table('bookings');
        $query = $builder->where('sno', $id)->update($data);
        return $query;
    }

    public function deleteBookingRooms($bookingSno)
    {
        return $this->db->table('booking_room_details')
            ->where('booking_sno', $bookingSno)
            ->delete();
    }

    public function getAllRoomTypeDetails()
    {
        $builder = $this->db->table('room_types');
        $query = $builder->get();
        return $query->getResult();
    }
    // Invoice
    public function insertInvoice($data)
    {
        $builder = $this->db->table('invoice_details');
        $query = $builder->insert($data);
        return $query;
    }
    public function getInvoiceByBookingId($bookingId)
    {
        return $this->db->table('invoice_details')
            ->where('booking_id', $bookingId)
            ->get()
            ->getRow();
    }
    public function getTotalAmountByBookingId($bookingId)
    {
        return $this->db->table('booking_room_details brd')
            ->select('
            rt.*,
            b.*,
            b.*
        ')
            ->join('bookings b', 'b.booking_id = brd.booking_id', 'left')
            ->join('room_types rt', 'rt.sno = brd.roomtype', 'left')
            ->where('brd.booking_id', $bookingId)
            ->get()
            ->getRow();
    }
    // Payment
    public function insertPayment($data)
    {
        $builder = $this->db->table('payments');
        $query = $builder->insert($data);
        return $query;
    }
    public function getBookingsWithPaymentSummary()
    {
        return $this->db->query("
        SELECT 
            b.*,
            IFNULL(SUM(p.payment_amount), 0) AS paid_amount,
            IFNULL(MAX(p.total_amount), 0) AS total_amount,
            IFNULL(MAX(p.balance), 0) AS balance
        FROM bookings b
        LEFT JOIN payments p 
            ON p.booking_id = b.booking_id
        GROUP BY b.booking_id
        ORDER BY b.sno DESC
         ")->getResult();
    }
    public function getTotalPaid($booking_id, $roomtype_sno, $room_no)
    {
        $row = $this->db->table('payments')
            ->selectSum('payment_amount', 'total_paid')    // sum only payment_amount
            ->where('booking_id', $booking_id)
            ->where('roomtype', $roomtype_sno)
            ->where('room_no', $room_no)
            ->get()
            ->getRow();

        return $row->total_paid ?? 0;
    }
    public function getTotalExtra($booking_id, $roomtype_sno, $room_no)
    {
        $row = $this->db->table('extra_charges')
            ->selectSum('total_amount', 'total_extra')
            ->where('booking_id', $booking_id)
            ->where('room_type', $roomtype_sno)   // filter by roomtype
            ->where('room_no', $room_no)         // filter by room no
            ->get()
            ->getRow();

        return $row->total_extra ?? 0;
    }


    // Get booked rooms for a booking
   public function getRoomsByBooking($booking_id)
    {
        $rooms = $this->db->table('booking_room_details br')
            ->select('
            br.sno as br_id,
            br.room_no,
            br.roomtype as roomtype_sno,
            r.roomtype,
            r.price_per_night,
            r.extra_adult_price,
            r.extra_children_price,
            rm.status
        ')
            ->join('room_types r', 'r.sno = br.roomtype', 'left')
            ->join('rooms rm', 'rm.room_number = br.room_no', 'left') // NO status filter
            ->where('br.booking_id', $booking_id)
            ->where('br.status', 1)
            ->get()
            ->getResultArray();

        foreach ($rooms as &$room) {
            $sumExtra = $this->db->table('extra_charges')
                ->selectSum('total_amount', 'total')
                ->where('booking_id', $booking_id)
                ->where('room_type', $room['roomtype_sno'])
                ->where('room_no', $room['room_no'])
                ->get()
                ->getRow()
                ->total ?? 0;

            $room['extraCharges'] = (float) $sumExtra;
        }

        return $rooms;
    }

    public function getBookingRooms($bookingId)
    {
        return $this->db->table('room_types br')
            ->select('*')
            ->join('roomtypes rt', 'rt.sno = br.roomtype')
            ->where('br.booking_id', $bookingId)
            ->get()
            ->getResultArray();
    }

    public function getRoomPaidAmount($roomtype_sno, $room_no)
    {
        $row = $this->db->table('payments')
            ->select('paid_amount as paid')
            ->where('roomtype', $roomtype_sno)
            ->where('room_no', $room_no)
            ->orderBy('sno', 'DESC') // or 'created_at' if you have a timestamp
            ->get()
            ->getRow();

        return [
            'paid' => isset($row->paid) ? floatval($row->paid) : 0
        ];
    }

    // Get all rooms
    public function getAllRooms()
    {
        return $this->db->table('room_types')
            ->select('*')
            ->get()
            ->getResultArray();
    }
    public function insertExtraCharge($data)
    {
        $builder = $this->db->table('extra_charges');
        $query = $builder->insert($data);
        return $query;
    }

    public function getBookingInfo($booking_id)
    {
        return $this->db->table('bookings')
            ->where('booking_id', $booking_id)
            ->get()
            ->getRowArray();
    }
    public function getBookingRoomsWithPayment($booking_id)
    {
        return $this->db->query("
        SELECT 
            br.booking_id,
            br.room_no,
            br.roomtype,
            rt.roomtype AS roomtype_name,

            -- STATUS FROM booking_room_details
            br.status,

            -- payment logic
            COALESCE(p.total_amount, rt.price_per_night) AS total_amount,
            COALESCE(p.paid_amount, 0) AS paid_amount,
            (COALESCE(p.total_amount, rt.price_per_night) - COALESCE(p.paid_amount, 0)) AS balance

        FROM booking_room_details br
        LEFT JOIN room_types rt 
            ON rt.sno = br.roomtype

        LEFT JOIN payments p 
            ON p.sno = (
                SELECT MAX(p2.sno)
                FROM payments p2
                WHERE p2.booking_id = br.booking_id
                  AND p2.roomtype   = br.roomtype
                  AND p2.room_no    = br.room_no
            )

        WHERE br.booking_id = ?
    ", [$booking_id])->getResultArray();
    }


    public function updateRoomStatus($booking_id, $room_type, $room_no, $status)
    {
        return $this->db->table('booking_room_details')
            ->where('booking_id', $booking_id)
            ->where('room_type', $room_type)
            ->where('room_no', $room_no)
            ->update([
                'status' => $status
            ]);
    }
    public function getBookingSnoByBookingId($booking_id)
    {
        return $this->db->table('bookings')
            ->select('sno')
            ->where('booking_id', $booking_id)
            ->get()
            ->getRow('sno');
    }
    public function insertBookingRoom($data)
    {
        $builder = $this->db->table('booking_room_details');
        $query = $builder->insert($data);
        return $query;
    }
    // Get roomtype by sno
    public function getRoomTypeById($sno)
    {
        return $this->db->table('room_types')
            ->where('sno', $sno)
            ->get()
            ->getRowArray();
    }
    // Get booking_sno from bookings table
    public function getBookingSnoById($booking_id)
    {
        $booking = $this->db->table('bookings')
            ->select('sno')
            ->where('booking_id', $booking_id)
            ->get()
            ->getRowArray();

        return $booking ? $booking['sno'] : null;
    }
    public function getBillDetails($bookingId)
    {
        $booking = $this->getBookingInfo($bookingId);
        if (!$booking) {
            return null;
        }

        $rooms = $this->getBookingRoomsWithPayment($bookingId);

        $paid = 0;
        $total = 0;

        foreach ($rooms as $room) {
            $paid  += $room['paid_amount'];
            $total += $room['total_amount'];
        }

        $extraAdult = $this->db->table('extra_charges')
            ->selectSum('total_amount', 'total')
            ->where('booking_id', $bookingId)
            ->where('charge_type', 'adult')
            ->get()
            ->getRow()
            ->total ?? 0;

        $extraChild = $this->db->table('extra_charges')
            ->selectSum('total_amount', 'total')
            ->where('booking_id', $bookingId)
            ->where('charge_type', 'child')
            ->get()
            ->getRow()
            ->total ?? 0;

        return [
            'booking'     => $booking,
            'rooms'       => $rooms,
            'paid'        => $paid,
            'extra_adult' => $extraAdult,
            'extra_child' => $extraChild,
            'total'       => $total + $extraAdult + $extraChild,
            'balance'     => ($total + $extraAdult + $extraChild) - $paid
        ];
    }
    public function getBookingById($booking_id)
    {
        return $this->db->table('bookings')
            ->where('booking_id', $booking_id)
            ->get()
            ->getRowArray();
    }
    public function updateRoomCheckout($booking_id, $room_id, $room_no, $newCheckout)
    {
        return $this->db->table('booking_room_details')
            ->where('booking_id', $booking_id)
            ->where('roomtype', $room_id)
            ->where('room_no', $room_no)
            ->update([
                'check_out'  => $newCheckout,
            ]);
    }
    public function updateBookingCheckout($booking_id, $newCheckout)
    {
        return $this->db->table('bookings')
            ->where('booking_id', $booking_id)
            ->update([
                'check_out' => $newCheckout,
                'updated_on' => date('Y-m-d H:i:s')
            ]);
    }
}
