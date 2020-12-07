<?php namespace App\Controllers;

use App\Models\VideoModel;
use CodeIgniter\API\ResponseTrait;

class Video extends BaseController
{
    use ResponseTrait;

    public function getList($limit=10, $offset=0)
    {
        $model = new VideoModel();
        $data = $model->getVideoList($limit, $offset);
        return $this->respond(formatSuccess($data), 200);
    }

    public function getVideoInfo()
    {
				$query = dataSet([
					'bvid' => ['bvid',true],
				]);

        $res = api("video", $query);
        return $this->respond($res, 200);
    }

    public function saveVideo()
    {
        $query = dataSet([
          'bvid' => ['bvid',true],
          'expiration' => ['expiration',true]
        ]);

        //请求API获取视频信息
        $video = api("video", ['bvid' => $query['bvid']]);

        if($video['code'] == 0){
          $video = $video['data'];
        }
        else{
          return $this->respond(formatError('暂时无法获取视频信息，请稍后重试'), 200);
        }

        $n_query = [
          'bvid' => [$query['bvid']],
          'ctime' => [$video['ctime']],
          'mid' => [$video['owner']['mid']],
          'owner_name' =>[$video['owner']['name']],
          'pic' => [$video['pic']],
          'title' => [$video['title']],
          'v_coin' => [$video['stat']['coin']],
          'v_danmaku' => [$video['stat']['danmaku']],
          'v_favorite' => [$video['stat']['favorite']],
          'v_like' => [$video['stat']['like']],
          'v_reply' => [$video['stat']['reply']],
          'v_share' => [$video['stat']['share']],
          'v_view' => [$video['stat']['view']],
        ];

        $model = new VideoModel();
        $expiration = false;

        switch($query['expiration']){
          case -1:
            $expiration = false;
            break;
          case 0:
            $expiration = 0;
            break;
          default:
            $expiration = date("Y-m-d",strtotime("+".$expiration." day"));
            break;
        }
        $data = $model->saveVideo($n_query,$expiration);

        if($data){
          return $this->respond(formatSuccess($data,'视频创建成功'), 200);
        }

        return $this->respond(formatError('暂时无法保存视频信息',200));
    }
}
