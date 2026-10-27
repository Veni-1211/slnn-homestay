<?php
namespace App\Models\backend;
use CodeIgniter\Model;
class AuthenticationModel extends Model
{
    public function getUserByEmail($email)
    {
        $table = $this->db->table('login');
        $result = $table->where('email', $email)->get()->getRowArray();

        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function getUserByMobile($mobile)
    {
        $table = $this->db->table('login');
        $result = $table->where('mobile', $mobile)->get()->getRowArray();

        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function insertDataIntoForgotOtp($data)
    {
        $contactTable = $this->db->table('forgot-password');
        $result = $contactTable->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getForgotOtpBySession($session_id)
    {
        $table = $this->db->table('forgot-password');

        $result = $table
            ->where('session_id', $session_id)
            ->orderBy('id', 'DESC')
            ->get()
            ->getRowArray();

        return !empty($result) ? $result : false;
    }

    public function verifyForgotOtp($session_id, $otp)
    {
        $table = $this->db->table('forgot-password');

        $result = $table
            ->where('session_id', $session_id)
            ->where('otp', $otp)
            ->get()
            ->getRowArray();

        return !empty($result) ? $result : false;
    }

    public function getUserBySession($session_id)
    {
        $table = $this->db->table('login');
        $result = $table->where('session_id', $session_id)
            ->get()
            ->getRowArray();

        return !empty($result) ? $result : false;
    }

    public function updatePasswordBySession($session_id, $data)
    {
        $table = $this->db->table('login');
        $table->where('session_id', $session_id);
        $table->update($data);

        return ($this->db->affectedRows() > 0);
    }
    public function deleteForgotOtpBySession($session_id)
    {
        $table = $this->db->table('forgot-password');
        $table->where('session_id', $session_id);
        $table->delete();

        return true;
    }

    public function insertDataIntoChangePasswordOtp($data)
{
    $table = $this->db->table('change_password_otp');
    $table->insert($data);

    if ($this->db->affectedRows() > 0) {
        return true;
    } else {
        return false;
    }
}
public function getChangePasswordOtpBySession($session_id)
{
    $table = $this->db->table('change_password_otp');
    $result = $table->where('session_id', $session_id)
                    ->orderBy('id', 'DESC')
                    ->get()
                    ->getRowArray();

    return $result ?: false;
}
public function deleteChangePasswordOtp($session_id)
{
    $table = $this->db->table('change_password_otp');
    $table->where('session_id', $session_id)->delete();

    return true;
}


}
?>