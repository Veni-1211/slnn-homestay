<?php
namespace App\Models\backend;
use CodeIgniter\Model;
class ReplyContactModel extends Model
{


    public function addContactReply($data)
    {
        $table = $this->db->table('contact_reply');
        $result = $table->insert($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function replyContactEnquires()
    {
        $table = $this->db->query('select * from contact');
        $result = $table->getResult();
        if (count($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function getPreviousReplies($contactId)
    {
        return $this->db->table('contact_reply')
            ->where('contact_id', $contactId)
            ->orderBy('id', 'DESC')
            ->get()
            ->getResult();
    }

    public function updateContactStatus($contactId)
    {
        return $this->db->table('contact')
            ->where('sno', $contactId)
            ->update([
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
    }
    public function updateContactByEmailStatus($contactId)
    {
        return $this->db->table('contact')
            ->where('sno', $contactId)
            ->update([
                'email_status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
    }
    public function getAllContacts()
    {
        return $this->db->table('contact')
            ->orderBy('sno', 'DESC')
            ->get()
            ->getResultArray();   // ✅ IMPORTANT
    }

    public function searchContacts($search)
    {
        return $this->db->table('contact')
            ->groupStart()
            ->like('name', $search)
            ->orLike('email', $search)
            ->groupEnd()
            ->orderBy('sno', 'DESC')
            ->get()
            ->getResultArray();   // ✅ IMPORTANT
    }
    public function getPreviousRepliesByType($contactId, $type)
    {
        return $this->db->table('contact_reply')
            ->where('contact_id', $contactId)
            ->where('reply_type', $type)
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResult();
    }
    public function getContactById($contactId)
    {
        return $this->db->table('contact')
            ->where('sno', $contactId)
            ->get()
            ->getRow();
    }
}
?>