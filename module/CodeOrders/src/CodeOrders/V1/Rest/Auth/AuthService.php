<?php

namespace CodeOrders\V1\Rest\Auth;

use CodeOrders\V1\Rest\Users\UsersEntity;

class AuthService
{
    /**
     * @var UsersEntity
     */
    private $user;

    /**
     * AuthService constructor.
     * @param UsersEntity $user
     */
    public function __construct(UsersEntity $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getUserRole()
    {
        return $this->user->getRole();
    }

    public function isAdmin()
    {
        return ($this->getUserRole() == 'admin') ? true : false;
    }

    public function hasRole($roles)
    {
        if (is_array($roles)) {
            if (in_array($this->getUserRole(), $roles)) {
                return true;
            }
        } elseif ($this->getUserRole() == $roles) {
            return true;
        }

        throw new \Exception('The user has not access to this info', 403);
    }
}
