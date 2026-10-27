<?php
namespace App\Models\backend;
use CodeIgniter\Model;
class BookingsReplyModel extends Model
{
   public function replyBookingsEnquires()
    {
        return $this->db->table('bookings_enquery')
            ->orderBy('sno', 'DESC')
            ->get()
            ->getResult();
    }

    /* ================= GET REPLIES BY BOOKING ================= */
    public function getRepliesByBooking($bookingId)
    {
        return $this->db->table('booking_replies')   
            ->where('booking_id', $bookingId)
            ->orderBy('id', 'DESC')
            ->get()
            ->getResult();
    }

    /* ================= ADD REPLY ================= */
    public function addBookingReply($data)
    {
        return $this->db->table('booking_replies')->insert($data);
    }

    /* ================= UPDATE STATUS ================= */
    public function updateBookingStatus($bookingId)
    {
        return $this->db->table('bookings_enquery')
            ->where('sno', $bookingId)
            ->update(['status' => 1]);
    }

}
?>