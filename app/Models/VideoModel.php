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

    public function saveVideo($data)
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
            $var = $builder->insert($data);
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
        else{
          return ['vid'=>$vid];
        }

    }

    //新建
    public function updateVideoInfo()
    {
    }
}
