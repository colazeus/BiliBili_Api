<?php namespace App\Controllers;

use App\Models\MemberModel;
use CodeIgniter\API\ResponseTrait;

class Channel extends BaseController
{
  use ResponseTrait;

  //周热榜列表
  public function getSeriesList($arr = false){
    $sList = api("seriesList")['data']['list'];
    if($arr)
      return $sList;
    else
      return $this->respond(formatSuccess($sList), 200);
  }

  //周热榜（默认最新）
  public function getSeries(){
    $query = dataSet([
      'number' => ['number',false],
    ]);

    if(!isSet($query['number'])){
      $sList = $this->getSeriesList(true);
      $query['number'] = $sList[0]['number'];
    }

    $series = api('series',['number' => $query['number']])['data'];
    return $this->respond(formatSuccess($series), 200);
  }

}
