<?php namespace App\Models;

class UserModel extends \CodeIgniter\Model
{
    //获取用户信息
    public function getUserByPhone($phone)
    {
      $db = db_connect();
      $builder = $db->table('user');

      $query = $builder->getWhere(['phone'=>$phone]);
      return $query->getRowArray();
    }

    //创建新用户
    public function createNewUser(string $phone,string $password,string $name)
    {
      $db = db_connect();
      $builder = $db->table('user');

      $builder->insert([
        'phone' => $phone,
        'password' => password_hash($password,PASSWORD_DEFAULT),
        'name' => $name
      ]);

      return true;

    }
}
