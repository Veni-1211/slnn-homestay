<?php
namespace App\Models\backend;
use CodeIgniter\Model;
class RoomsAvailabilityModel extends Model
{
    public function getAllRoomDetails($checkin = null, $checkout = null)
    {
        $builder = $this->db->table('booking_room_details');

        if ($checkin && $checkout) {
            $builder->where('check_in >=', $checkin)
                ->where('check_out <=', $checkout);
        }

        return $builder->orderBy('roomtype', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getRoomsAvailability($date)
    {
        return $this->db->table('rooms r')
            ->select('
            r.room_number,
            rt.roomtype,
            b.room_no AS occupied_room
        ')
            ->join('room_types rt', 'rt.sno = r.roomtype_id', 'left')
            ->join(
                'booking_room_details b',
                'b.room_no = r.room_number AND b.status = 1',
                'left'
            )
            ->orderBy('rt.roomtype', 'ASC')
            ->get()
            ->getResultArray();
    }





}
?>