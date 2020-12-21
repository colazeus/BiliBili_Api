<?php namespace App\Controllers;

use App\Models\MemberModel;
use CodeIgniter\API\ResponseTrait;

class Member extends BaseController
{
    use ResponseTrait;

    public function getList($limit=10, $offset=0)
    {
        $model = new MemberModel();
        $data = $model->getMemberList($limit, $offset);
        return $this->respond(formatSuccess($data), 200);
    }
}
