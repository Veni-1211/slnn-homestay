<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class RoomsModel extends Model
{
    public function getAllRoomTypeDetails()
    {
        $builder = $this->db->table('room_types');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getRoomTypeDetailsById($id)
    {
        $builder = $this->db->table('room_types');
        $builder->where('sno', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function deleteRoomTypeByIdStatus($id, $status)
    {
        $builder = $this->db->table('room_types');
        $builder->where('sno', $id);
        if ($status == 1) {
            return  $builder->update(['status' => 0]);
        }
        if ($status == 0) {
            return $builder->update(['status' => 1]);
        }
    }

    public function insertIntoRoomType($data)
    {
        $builder = $this->db->table('room_types');
        $query = $builder->insert($data);
        return $query;
    }

    public function updateIntoRoomType($id, $data)
    {
        $builder = $this->db->table('room_types');
        $query = $builder->where('sno', $id)->update($data);
        return $query;
    }

    // rooms
    public function getAllRoomDetails()
    {
        $builder = $this->db->table('rooms');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getRoomDetailsById($id)
    {
        $builder = $this->db->table('rooms');
        $builder->where('sno', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function deleteRoomByIdStatus($id, $status)
    {
        $builder = $this->db->table('rooms');
        $builder->where('sno', $id);
        if ($status == 1) {
            return  $builder->update(['status' => 0]);
        }
        if ($status == 0) {
            return $builder->update(['status' => 1]);
        }
    }

    public function insertIntoRoom($data)
    {
        $builder = $this->db->table('rooms');
        $query = $builder->insert($data);
        return $query;
    }

    public function updateIntoRoom($id, $data)
    {
        $builder = $this->db->table('rooms');
        $query = $builder->where('sno', $id)->update($data);
        return $query;
    }
}
