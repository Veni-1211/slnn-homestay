<?php

namespace App\Models\frontend;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    public function insertIntoContact($data)
    {
        return $this->db->table('contact')
            ->insert($data);
    }
    public function insertBooking($data)
    {
        return $this->db->table('bookings_enquery')
            ->insert($data);
    }
    public function getdetailsByRoomType($roomType)
    {
        return $this->db->table('room_types')
            ->where('roomtype', $roomType)
            ->get()
            ->getResultArray();
    }
    public function getAllTestimonials()
    {
        $builder = $this->db->table('testimonials');
        $query = $builder->get();
        return $query->getResult();
    }
}
