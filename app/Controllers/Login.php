<?php namespace App\Controllers;

use App\Models\VideoModel;
use CodeIgniter\API\ResponseTrait;

class Login extends BaseController
{
  use ResponseTrait;

	public function index()
	{
      $data = [
        'token' => "aabbvvdd",
      ];
			return $this->respond(formatSuccess($data), 200);
	}
}
