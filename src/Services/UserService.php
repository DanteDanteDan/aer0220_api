<?php

namespace App\Services;

use PDO;
use App\Models\aer0220_users;
use Psr\Container\ContainerInterface;
use Illuminate\Database\Eloquent\Collection;
use Firebase\JWT\JWT;

class UserService
{
    private $_logger;
    private $_secretKey;

    public function __construct(ContainerInterface $container)
    {
        //$this->_container = $container;
        //$this->_logger = new $container->get('logger');
        $this->_secretKey = $container->get('settings')['secretKey'];
    }

    public function getAll(): Collection
    {
        return aer0220_users::all();
    }

    public function getUser(int $user_id)
    {
        //return aer0220_users::find($courses_id);
        $db = new DataBase();
        $db = $db->conectDB();
        $sql = "SELECT * FROM aer0220_users where user_id = $user_id ";
        $content = $db->query($sql);
        $result = $content->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function create($obj)
    {
        $entry = new aer0220_users;

        $entry->email = $obj->email;
        $entry->password = md5($obj->password);
        $entry->user_type_id = $obj->user_type_id;

        $entry->save();

        return $entry;
    }

    public function authenticate(string $email, string $password): ?array
    {
        //$password = md5($password);

        $user = aer0220_users::where('password', $password)
                             ->where('email',$email)
                             ->first();

        if ($user) {
            $time = time();

            $token = [
                'iat' => $time,
                'exp' => $time + (60 * 21600), // 15 days
                'sub' => $user->id,
            ];

            return [
                'access_token' => JWT::encode($token, $this->_secretKey),
                'user' => [
                    'email' => $user->email,
                    'user_type_id' => $user->user_type_id
                ],
            ];
        }

        return $user;
    }



}
