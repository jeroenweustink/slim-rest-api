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

        if ($data === null) {
            self::response(self::STATUS_NOT_FOUND);
            return;
        }

        $response = array('user' => $data);
        self::response(self::STATUS_OK, $response);
    }

    /**
     * Create user
     */
    public function post()
    {
        $email = $this->getSlim()->request()->params('email');
        $password = $this->getSlim()->request()->params('password');

        if (empty($email) || empty($password) || $email === null || $password === null) {
            self::response(self::STATUS_BAD_REQUEST);
            return;
        }

        $user = $this->getUserService()->createUser($email, $password);

        self::response(self::STATUS_CREATED, array('user', $user));
    }

    /**
     * Update user
     */
    public function put($id)
    {
        $email = $this->getSlim()->request()->params('email');
        $password = $this->getSlim()->request()->params('password');

        if (empty($email) && empty($password) || $email === null && $password === null) {
            self::response(self::STATUS_BAD_REQUEST);
            return;
        }

        $user = $this->getUserService()->updateUser($id, $email, $password);

        if ($user === null) {
            self::response(self::STATUS_NOT_IMPLEMENTED);
            return;
        }

        self::response(self::STATUS_NO_CONTENT);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $status = $this->getUserService()->deleteUser($id);

        if ($status === false) {
            self::response(self::STATUS_NOT_FOUND);
            return;
        }

        self::response(self::STATUS_OK);
    }

    /**
     * Show options in header
     */
    public function options()
    {
        self::response(self::STATUS_OK, array(), array('GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'));
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

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
}