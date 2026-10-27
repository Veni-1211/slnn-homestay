<?php

namespace App\Controllers\backend;

use CodeIgniter\Controller;
use App\Models\backend\RoomsModel;

class RoomsController extends Controller
{
    public $email;
    public $session;
    public $RoomsModel;
    public function __construct()
    {
        helper('form');
        helper(['form']);
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
        $this->RoomsModel = new RoomsModel();
    }

    public function manage_room_types()
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . 'logout');
        }
        $data['pageName'] = 'Manage Room Types';
        $data['getAllRoomTypeDetails'] = $this->RoomsModel->getAllRoomTypeDetails();
        echo view('backend/includes/header.php', $data);
        echo view('backend/Rooms/manage-room-types.php', $data);
        echo view('backend/includes/footer.php');
    }

    public function view_room_types($id)
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . 'logout');
        }
        $data['pageName'] = 'Manage Room Types';
        $data['getRoomTypeDetailsById'] = $this->RoomsModel->getRoomTypeDetailsById($id);
        echo view('backend/includes/header.php', $data);
        echo view('backend/Rooms/view-room-types.php', $data);
        echo view('backend/includes/footer.php');
    }

    public function delete_room_types($id1, $id2)
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . 'logout');
        }
        $sessionId = session()->get('logged_user');
        $deleteRoomTypeByIdStatus = $this->RoomsModel->deleteRoomTypeByIdStatus($id1, $id2);
        if ($deleteRoomTypeByIdStatus) {
            return redirect()->to(base_url() . 'manage-room-types');
        } else {
            return redirect()->to(base_url() . 'manage-room-types');
        }
    }

    public function add_room_types()
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . 'logout');
        }
        $sessionId = session()->get('logged_user');
        $data = [];
        $data['pageName'] = 'Add Room Types';
        $data['validation'] = null;
        if ($this->request->getMethod() == 'post') {
            $roomtype = $this->request->getVar('roomtype');
            $price_per_night = $this->request->getVar('price_per_night');
            $max_adults = $this->request->getVar('max_adults');
            $max_children = $this->request->getVar('max_children');
            $weekend_price = $this->request->getVar('weekend_price');
            $seasonal_price = $this->request->getVar('seasonal_price');
            $extra_adult_price = $this->request->getVar('extra_adult_price');
            $extra_children_price = $this->request->getVar('extra_children_price');
            $cleaning_fee = $this->request->getVar('cleaning_fee');
            $service_charges = $this->request->getVar('service_charges');
            $description = $this->request->getVar('description');
            $rules = [
                'roomtype' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Room Type is Required'
                    ],
                ],
                'price_per_night' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Price Per Night is Required'
                    ],
                ],
            ];
            if ($this->validate($rules)) {
                $addInfo = [
                    'roomtype' => $roomtype,
                    'price_per_night' => $price_per_night,
                    'max_adults' => $max_adults,
                    'max_children' => $max_children,
                    'weekend_price' => $weekend_price,
                    'seasonal_price' => $seasonal_price,
                    'extra_adult_price' => $extra_adult_price,
                    'extra_children_price' => $extra_children_price,
                    'cleaning_fee' => $cleaning_fee,
                    'service_charges' => $service_charges,
                    'description' => $description,
                    'status' => 1,
                    'created_by' => $sessionId,
                    'created_on' => date('Y-m-d H:i:s'),
                ];
                $insertIntoRoomType = $this->RoomsModel->insertIntoRoomType($addInfo);
                if ($insertIntoRoomType) {
                    return redirect()->to(base_url() . 'manage-room-types');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        echo view('backend/includes/header.php', $data);
        echo view('backend/Rooms/add-room-types.php', $data);
        echo view('backend/includes/footer.php');
    }

    public function edit_room_types($id)
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . 'logout');
        }
        $sessionId = session()->get('logged_user');
        $data = [];
        $data['pageName'] = 'Manage Rooms';
        $data['validation'] = null;
        $data['getRoomTypeDetailsById'] = $this->RoomsModel->getRoomTypeDetailsById($id);
        if ($this->request->getMethod() == 'post') {
            $roomtype = $this->request->getVar('roomtype');
            $price_per_night = $this->request->getVar('price_per_night');
            $max_adults = $this->request->getVar('max_adults');
            $max_children = $this->request->getVar('max_children');
            $weekend_price = $this->request->getVar('weekend_price');
            $seasonal_price = $this->request->getVar('seasonal_price');
            $extra_adult_price = $this->request->getVar('extra_adult_price');
            $extra_children_price = $this->request->getVar('extra_children_price');
            $cleaning_fee = $this->request->getVar('cleaning_fee');
            $service_charges = $this->request->getVar('service_charges');
            $description = $this->request->getVar('description');
            $rules = [
                'roomtype' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Room Type is Required'
                    ],
                ],
                'price_per_night' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Price Per Night is Required'
                    ],
                ],
            ];
            if ($this->validate($rules)) {
                $addInfo = [
                    'roomtype' => $roomtype,
                    'price_per_night' => $price_per_night,
                    'max_adults' => $max_adults,
                    'max_children' => $max_children,
                    'weekend_price' => $weekend_price,
                    'seasonal_price' => $seasonal_price,
                    'extra_adult_price' => $extra_adult_price,
                    'extra_children_price' => $extra_children_price,
                    'cleaning_fee' => $cleaning_fee,
                    'service_charges' => $service_charges,
                    'description' => $description,
                    'status' => 1,
                    'updated_by' => $sessionId,
                    'updated_on' => date('Y-m-d H:i:s'),
                ];
                $updateIntoRoomType = $this->RoomsModel->updateIntoRoomType($id, $addInfo);
                if ($updateIntoRoomType) {
                    return redirect()->to(base_url() . 'manage-room-types');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        echo view('backend/includes/header.php', $data);
        echo view('backend/Rooms/edit-room-types.php', $data);
        echo view('backend/includes/footer.php');
    }

    // rooms
    public function manage_rooms()
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . 'logout');
        }
        $data['pageName'] = 'Manage Room';
        $data['getAllRoomDetails'] = $this->RoomsModel->getAllRoomDetails();
        echo view('backend/includes/header.php', $data);
        echo view('backend/Rooms/manage-rooms.php', $data);
        echo view('backend/includes/footer.php');
    }

    public function view_rooms($id)
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . 'logout');
        }
        $data['pageName'] = 'Manage Rooms';
        $data['getRoomDetailsById'] = $this->RoomsModel->getRoomDetailsById($id);
        echo view('backend/includes/header.php', $data);
        echo view('backend/Rooms/view-rooms.php', $data);
        echo view('backend/includes/footer.php');
    }

    public function delete_rooms($id1, $id2)
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . 'logout');
        }
        $sessionId = session()->get('logged_user');
        $deleteRoomByIdStatus = $this->RoomsModel->deleteRoomByIdStatus($id1, $id2);
        if ($deleteRoomByIdStatus) {
            return redirect()->to(base_url() . 'manage-rooms');
        } else {
            return redirect()->to(base_url() . 'manage-rooms');
        }
    }

    public function add_rooms()
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . 'logout');
        }
        $sessionId = session()->get('logged_user');
        $data = [];
        $data['pageName'] = 'Add Rooms';
        $data['validation'] = null;
        $data['getAllRoomTypeDetails'] = $this->RoomsModel->getAllRoomTypeDetails();
        if ($this->request->getMethod() == 'post') {
            $roomtype_id = $this->request->getVar('roomtype_id');
            $room_number = $this->request->getVar('room_number');
            $rules = [
                'roomtype_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Room Type is Required'
                    ],
                ],
                'room_number' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Room Number is Required'
                    ],
                ],
            ];
            if ($this->validate($rules)) {
                $addInfo = [
                    'roomtype_id' => $roomtype_id,
                    'room_number' => $room_number,
                    'status' => 1,
                    'created_by' => $sessionId,
                    'created_on' => date('Y-m-d H:i:s'),
                ];
                $insertIntoRoom = $this->RoomsModel->insertIntoRoom($addInfo);
                if ($insertIntoRoom) {
                    return redirect()->to(base_url() . 'manage-rooms');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        echo view('backend/includes/header.php', $data);
        echo view('backend/Rooms/add-rooms.php', $data);
        echo view('backend/includes/footer.php');
    }

    public function edit_rooms($id)
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . 'logout');
        }
        $sessionId = session()->get('logged_user');
        $data = [];
        $data['pageName'] = 'Manage Rooms';
        $data['validation'] = null;
        $data['getRoomDetailsById'] = $this->RoomsModel->getRoomDetailsById($id);
        $data['getAllRoomTypeDetails'] = $this->RoomsModel->getAllRoomTypeDetails();
        if ($this->request->getMethod() == 'post') {
            $roomtype_id = $this->request->getVar('roomtype_id');
            $room_number = $this->request->getVar('room_number');
            $rules = [
                'roomtype_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Room Type is Required'
                    ],
                ],
                'room_number' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Room Number is Required'
                    ],
                ],
            ];
            if ($this->validate($rules)) {
                $addInfo = [
                    'roomtype_id' => $roomtype_id,
                    'room_number' => $room_number,
                    'status' => 1,
                    'updated_by' => $sessionId,
                    'updated_on' => date('Y-m-d H:i:s'),
                ];
                $updateIntoRoom = $this->RoomsModel->updateIntoRoom($id, $addInfo);
                if ($updateIntoRoom) {
                    return redirect()->to(base_url() . 'manage-rooms');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        echo view('backend/includes/header.php', $data);
        echo view('backend/Rooms/edit-rooms.php', $data);
        echo view('backend/includes/footer.php');
    }
}
