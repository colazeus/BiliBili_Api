<?php

if (! function_exists('getApi'))
{
  //API调用
  function api($api,$query = []){
    $config = config('Api');
    $url = $config->$api['url'];
    $type = $config->$api['type'];
    return getRequest($type,$url,$query);
  }

  //请求
  function getRequest($type,$api,$query){
    $client = \Config\Services::curlrequest();
    $client -> setHeader('User-Agent','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.67 Safari/537.36');
    $client -> setHeader('Accept','application/json');
    $client -> setHeader('Access-Control-Allow-Origin','*');

    switch($type){
      case 'GET':
        $response = $client->get($api,['query'=>$query]);
        if (strpos($response->getHeader('content-type'), 'application/json') !== false)
        {
          $body = $response->getBody();
          $body = json_decode($body,true);
          return $body;
        }
      break;
    }

  }

  //数组赋值校验
  function dataSet($rule){
    $data = [];
    foreach ($rule as $key => $value){
      $parname = $value[0];
      $isNull = $value[1];

      if(service('request')->getPostGet($parname)){
        $data[$key] = service('request')->getPostGet($parname);
      }
      else if($isNull){
        if(isset($value[2])){
          echo json_encode(formatError($message));
        }
        else{
          echo json_encode(formatError('缺少必要的参数:'.$parname));
        }
        exit();
      }
    }
    return $data;
  }

  //错误格式化
  function formatError($message,$code=1){
    $res = ['code' => $code,
      'message' => $message,
    ];
    return $res;
  }

  function formatSuccess($data,$message='',$code=0){
    $res = ['code' => $code,
      'data' => $data,
      'message' => $message
    ];
    return $res;
  }
}
