<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class User extends BaseController
{
  use ResponseTrait;

	public function login()
	{
      $query = dataSet([
        'phone' => ['phone',true],
        'password' => ['password',true]
      ]);
      $model = new UserModel();
      $user = $model->getUserByPhone($query['phone']);

      if($user){
        if(password_verify($query['password'],$user['password']) === true){
          $token = $this->jwt->getToken($user['id']);
    			return $this->respond(formatSuccess(['token'=>$token]), 200);
        }
        else{
          return $this->respond(formatError("密码错误"),200);
        }
      }
      else{
        return $this->respond(formatError("找不到用户"),200);
      }
	}

  public function signup()
  {
      $query = dataSet([
        'phone' => ['phone',true],
        'password' => ['password',true],
        'name' => ['name',true]
      ]);

      $model = new UserModel();
      $model->createNewUser($query['phone'],$query['password'],$query['name']);

      return $this->respond(formatSuccess("","用户创建成功"),200);
  }
}
