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

    public function getInfo()
    {
        $query = dataSet([
          'mid' => ['mid',true],
        ]);
        $model = new MemberModel();
        $data = $model->getMemberInfo($query['mid']);
        return $this->respond(formatSuccess($data), 200);
    }

    public function getVideoList()
    {
        $query = dataSet([
          'mid' => ['mid',true],
        ]);

        $model = new MemberModel();
        $member = $model->getMemberInfo($query['mid']);

        $data = [
          'pn' => '1',
          'mid' => $member['bmid'],
          'ps' => '10',
          'order' => 'click',
          'index' => '1'
        ];

        $b_video = api("searchVideo", $data);
        $b_video = $b_video['data']['list']['vlist'];
        $video = [];
        foreach ($b_video as $v){
          $video[] = [
            'title' => $v['title'],
            'pic' => $v['pic'],
            'owner_name' => $v['author'],
            'bvid' => $v['bvid'],
            'create_time' => date('Y-m-d H:i:s',$v['created']),
          ];
        }

        return $this->respond(formatSuccess($video), 200);
    }
}
