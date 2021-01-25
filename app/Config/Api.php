<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Api extends BaseConfig
{
  //获取视频详情页
  public $video = [
    'url' => 'http://api.bilibili.com/x/web-interface/view',
    'type' => 'GET',
  ];

  //视频搜索
  public $searchVideo = [
    'url' => 'https://api.bilibili.com/x/space/arc/search',
    'type' => 'GET',
  ];

  //周榜列表
  public $seriesList = [
    'url' => 'https://api.bilibili.com/x/web-interface/popular/series/list',
    'type' => 'GET',
  ];

  //周榜排行
  public $series = [
    'url' => 'https://api.bilibili.com/x/web-interface/popular/series/one',
    'type' => 'GET',
  ];

}
