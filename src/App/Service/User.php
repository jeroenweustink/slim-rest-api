<?php

namespace App\Service;

use App\Service;

class User extends Service
{
    /**
     * @param $id
     * @return object
     */
    public function getUser($id)
    {
        /**
         * @var \App\Entity\User $user
         */
        $repository = $this->getEntityManager()->getRepository('App\Entity\User');
        $user = $repository->find($id);

        if ($user === null) {
            return null;
        }

        return array(
            'id' => $user->getId(),
            'created' => $user->getCreated(),
            'updated' => $user->getUpdated(),
            'email' => $user->getEmail(),
            'name' => $user->getName()
        );
    }

    /**
     * @return array|null
     */
    public function getUsers()
    {
        $repository = $this->getEntityManager()->getRepository('App\Entity\User');
        $users = $repository->findAll();

        if (empty($users)) {
            return null;
        }

        /**
         * @var \App\Entity\User $user
         */
        $data = array();
        foreach ($users as $user)
        {
            $data[] = array(
                'id' => $user->getId(),
                'created' => $user->getCreated(),
                'updated' => $user->getUpdated(),
                'email' => $user->getEmail(),
                'name' => $user->getName()
            );
        }

        return $data;
    }
}