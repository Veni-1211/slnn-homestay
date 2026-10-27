<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class ReportsModel extends Model
{
    public function getAllBookingDetails()
    {
        $builder = $this->db->table('bookings');
        $builder->orderBy('sno', 'desc');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getAllTestimonials()
    {
        $builder = $this->db->table('testimonials');
        $query = $builder->get();
        return $query->getResult();
    }

    public function insertIntoTestimonials($data)
    {
        $builder = $this->db->table('testimonials');
        $query = $builder->insert($data);
        return $query;
    }

    public function updateIntoTestimonials($Id, $data)
    {
        $builder = $this->db->table('testimonials');
        $builder->where('sno', $Id);
        return  $builder->update($data);
    }

    public function getAllTestimonialDetailsById($id)
    {
        $builder = $this->db->table('testimonials');
        $builder->where('sno', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function deleteTestimonialByIdStatus($id, $status)
    {
        $builder = $this->db->table('testimonials');
        $builder->where('sno', $id);
        if ($status == 1) {
            return $builder->update(['status' => 0]);
        }
        if ($status == 0) {
            return $builder->update(['status' => 1]);
        }
    }

    public function getAllBookingRoomDetailsBySno($sno)
    {
        $builder = $this->db->table('booking_room_details');
        $builder->where('booking_sno', $sno);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function countRoomsPerId($roomtype)
    {
        $builder = $this->db->table('booking_room_details');
        $builder->where('booking_sno', $roomtype);
        $query = $builder->get();
        return $query->getNumRows();
    }

    public function getPaymentTotalsByBookingId($booking_id)
    {
        return $this->db->table('payments')
            ->select('
            SUM(total_amount) AS total_amount,
            SUM(paid_amount)  AS paid_amount,
            SUM(balance) As balance_amount
        ')
            ->where('booking_id', $booking_id)
            ->get()
            ->getRowArray();
    }

    public function getRoomTypeById($roomtype)
    {
        $builder = $this->db->table('room_types');
        $builder->where('sno', $roomtype);
        $query = $builder->get();
        return $query->getRowArray();
    }
}
