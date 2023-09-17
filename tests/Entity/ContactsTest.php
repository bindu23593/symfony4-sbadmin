<?php

namespace App\Tests\Entity;

use App\Entity\Contacts;
use App\Tests\BaseTestClass;

class ContactsTest extends BaseTestClass
{
    public function testCreateContacts()
    {
        $contact = new Contacts();
        $contact->setName('Bindiya Patel');
        $contact->setEmail('bindiya@patel.com');
        $contact->setPhone('123-456-7890');
        $contact->setMessage("This is test message");

        $this->entityManager->persist($contact);
        $this->entityManager->flush();

        $this->assertNotNull($contact->getId());
    }
}
