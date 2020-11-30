<?php namespace App\Controllers;

use App\Models\VideoModel;

class Video extends BaseController
{
	public function getList($limit=10,$offset=0)
	{
      $model = new VideoModel();
			$data['data'] = $model->getVideoList($limit,$offset);
			return json_encode($data);
	}
}
