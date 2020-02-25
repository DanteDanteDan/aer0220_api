<?php

namespace App\Services;

use App\Models\users;
use Psr\Container\ContainerInterface;
use Illuminate\Database\Eloquent\Collection;
use Firebase\JWT\JWT;

class UserService
{
    private $_secretKey;

    public function __construct(ContainerInterface $container)
    {
        $this->_secretKey = $container->get('settings')['secretKey'];
    }

    public function getAll(): Collection // View All Users
    {
        $result = users::all();

        foreach ($result as $item) { // FK user_type_id
            $item->userType;
        }

        return $result;
    }

    public function getUser(int $user_id) // View One User
    {
        $user = users::where('user_id', $user_id)
            ->first();

        $user->userType; // FK user_type_id

        return $user;
    }

    public function create($obj) // Create User
    {
        $entry = new users;

        $entry->email        = $obj->email;
        $entry->password     = md5($obj->password); // encrypt
        $entry->user_type_id = $obj->user_type_id;

        $entry->save();

        return $entry;
    }

    public function authenticate(string $email, string $password): ?array // Create session validation token
    {
        $password = md5($password); // encrypt

        $user = users::where('password', $password)
            ->where('email', $email)
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
