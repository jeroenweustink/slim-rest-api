<?php

namespace App\Resource;

use App\Resource;
use App\Service\User as UserService;

class User extends Resource
{
    /**
     * @var \App\Service\User
     */
    private $userService;

    /**
     * Get user service
     */
    public function init()
    {
        $this->setUserService(new UserService($this->getEntityManager()));
    }

    /**
     * @param null $id
     */
    public function get($id = null)
    {
        if ($id === null) {
            $data = $this->getUserService()->getUsers();
        } else {
            $data = $this->getUserService()->getUser($id);
        }

        $response = array('user' => $data);
        $this->response(self::STATUS_OK, $response);
    }

    /**
     * Create a entry for later use
     */
    public function post()
    {

    }

    /**
     * @return \App\Service\User
     */
    public function getUserService()
    {
        return $this->userService;
    }

    /**
     * @param \App\Service\User $userService
     */
    public function setUserService($userService)
    {
        $this->userService = $userService;
    }
}