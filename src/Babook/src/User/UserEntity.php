<?php
declare(strict_types=1);
namespace App\User;

class UserEntity
{
    public $id;
    public $password;
    public $email;
    public $profile;
    public function getArrayCopy()
    {
        return [
            'id'       => $this->id,
            'email'     => $this->email,
            'password'    => $this->password,
            'profile'    => $this->profile,
        ];
    }
    public function exchangeArray(array $array)
    {
        $this->id    = $array['id'];
        $this->email  = $array['email'];
        $this->password = $array['password'];
        $this->profile = $array['profile'];
    }
}
