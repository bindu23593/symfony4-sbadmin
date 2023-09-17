<?php

namespace App\Tests\Entity;

use App\Entity\User;
use App\Tests\BaseTestClass;

class UserTest extends BaseTestClass
{
    public function testCreateUser()
    {
        $user = new User();
        $user->setEmail('user@user.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword('secret');

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->assertNotNull($user->getId());
    }
}
