<?php namespace App\Models;

class MemberModel extends \CodeIgniter\Model
{
    public function getMemberList($limit=10, $offset=0)
    {
        $db = db_connect();
        $builder = $db->table('member');

        $query = $builder->get($limit, $offset);
        return $query->getResultArray();
    }
}
