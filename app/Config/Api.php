<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Api extends BaseConfig
{
  //获取视频详情页
  public $video = [
    'url' => 'http://api.bilibili.com/x/web-interface/view',
    'type' => 'GET',
  ];

}
