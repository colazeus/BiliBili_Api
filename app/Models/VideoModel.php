<?php namespace App\Models;

class VideoModel extends \CodeIgniter\Model
{
    public function getVideoList($limit=10, $offset=0)
    {
        $db = db_connect();
        $builder = $db->table('video');

        $query = $builder->get($limit, $offset);
        return $query->getResultArray();
    }

    public function saveVideo($data,$expiration=false)
    {
        $db = db_connect();

        //事务开始
        $this->db->transStart();
        $builder = $db->table('video');
        $query = $builder->getWhere(['bvid'=>$data['bvid']]);
        $res = $query->getRowArray();

        //如果已存在则更新条目
        if ($res != NULL) {
            $vid = $res['id'];
            $builder->where('id', $vid);
            $builder->update(
            ['v_coin' => $data['v_coin'],
            'v_danmaku' => $data['v_danmaku'],
            'v_favorite' => $data['v_favorite'],
            'v_like' => $data['v_like'],
            'v_reply' => $data['v_reply'],
            'v_share' => $data['v_share'],
            'v_view' => $data['v_view'],
            ]);
        }
        //如果不存在就新建条目
        else {
            $builder->insert($data);
            $vid = $this->db->query('SELECT LAST_INSERT_ID()')->getRowArray()['LAST_INSERT_ID()'];
        }
        //自动建立一条刷新
        $builder = $db->table('base_video_data');
        $builder->insert(
        ['vid' => $vid,
        'v_coin' => $data['v_coin'],
        'v_danmaku' => $data['v_danmaku'],
        'v_favorite' => $data['v_favorite'],
        'v_like' => $data['v_like'],
        'v_reply' => $data['v_reply'],
        'v_share' => $data['v_share'],
        'v_view' => $data['v_view'],
        ]);

        //事务结束
        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
          return false;
        }

        if($expiration !== false){
          $this->saveGeter($vid,$data['bvid'],$expiration);
        }

        return ['vid'=>$vid];


    }

    //创建一个捕捉规则
    public function saveGeter($vid,$bvid,$expiration)
    {
        $db = db_connect();
        $builder = $db->table('get_video_list');

        if($expiration == 0){
          $expiration_type = 0;
          $expiration_time = "2099-01-01";
        }
        else{
          $expiration_type = 1;
          $expiration_time = $expiration;
        }

        $query = $builder->getWhere(['bvid'=>$bvid]);
        $res = $query->getRowArray();

        if ($res != NULL){
          $builder->where('bvid', $bvid);
          $builder->update([
            'expiration_type' => $expiration_type,
            'expiration_time' => $expiration_time
          ]);
        }
        else{
          $builder->insert([
            'vid' => $vid,
            'bvid' => $bvid,
            'expiration_type' => $expiration_type,
            'expiration_time' => $expiration_time
          ]);
        }

    }

    //更新视频信息
    public function updateVideoInfo()
    {
    }
}
