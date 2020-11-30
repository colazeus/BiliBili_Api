<?php namespace App\Models;

class VideoModel extends \CodeIgniter\Model
{
  public function getVideoList($limit=10,$offset=0){
    $db = db_connect();
    $builder = $db->table('video');

    $query = $builder->get($limit,$offset);
    return $query->getResultArray();
  }
}
