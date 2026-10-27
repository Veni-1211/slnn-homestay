<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    public function getTotalBookingCount()
    {
        $builder = $this->db->table('bookings');
        return $builder->countAllResults();
    }

    public function getTotalRoomCount()
    {
        $builder = $this->db->table('rooms');
        return $builder->countAllResults();
    }

    public function getTotalRevenueFromPayments()
    {
        $builder = $this->db->table('payments');
        $builder->selectSum('total_amount');
        $query = $builder->get();
        $result = $query->getRow();
        return $result ? $result->total_amount : 0;
    }

    public function getTotalPaidFromPayments()
    {
        $builder = $this->db->table('payments');
        $builder->selectSum('paid_amount');
        $query = $builder->get();
        $result = $query->getRow();
        return $result ? $result->paid_amount : 0;
    }

    public function getTotalOccupiedRooms()
    {
        $builder = $this->db->table('booking_room_details');
        $builder->where('status', '1');
        return $builder->countAllResults();
    }

    public function getTotalFeedbacks()
    {
        $builder = $this->db->table('testimonials');
        return $builder->countAllResults();
    }

    public function getTotalBookingEnquiries()
    {
        $builder = $this->db->table('bookings_enquery');
        return $builder->countAllResults();
    }

    public function getPendingBookingEnquiries()
    {
        $builder = $this->db->table('bookings_enquery');
        $builder->where('status', '0');
        return $builder->countAllResults();
    }

    public function getTotalContactEnquiries()
    {
        $builder = $this->db->table('contact');
        return $builder->countAllResults();
    }
    public function getPendingContactEnquiries()
    {
        $builder = $this->db->table('contact');
        $builder->where('status', '0')->where('email_status', '0');
        return $builder->countAllResults();
    }

    public function getExpectedTodayCheckoutsCount()
    {
        $today = date('Y-m-d');
        return $this->db->table('booking_room_details')
            ->where('DATE(check_out)', $today)
            ->countAllResults();
    }
}
