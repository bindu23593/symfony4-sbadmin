<?php

namespace App\Tests\Controller;

use App\Entity\Contacts;
use App\Repository\ContactsRepository;
use App\Repository\UserRepository;
use App\Tests\BaseTestClass;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class ContactsControllerTest extends BaseTestClass
{
    protected $contactRepository;

    public function setup(): void
    {
        parent::setup();
        $this->contactRepository = static::$container->get(ContactsRepository::class);
        $this->createAdminUser();
    }
    /**
     * Test that the contact page requires authentication.
     */
    public function testContactPageRequiresAuthentication()
    {
        $this->client->request('GET', '/contacts');
        $this->assertResponseRedirects('/login');
    }

    /**
     * Test case for the testContactNewInvalidEmail method.
     *
     * This method tests the behavior of the contact form when an invalid email address is provided.
     *
     * @throws Exception If the test is skipped.
     */
    public function testContactNewInvalidEmail()
    {
        // $this->markTestSkipped('must be revisited.');
        $this->logIn();
        $crawler = $this->client->request('GET', '/contacts/new');

        $form = $crawler->selectButton('Save')->form([
            'contacts[name]' => 'Bindiya Patel',
            'contacts[email]' => 'bindiya',
            'contacts[phone]' => '123-456-7890',
            'contacts[message]' => 'Hello, this is a test message.',
        ]);

        $this->client->submit($form);
        $htmlContent = $this->client->getResponse()->getContent();
        $this->assertStringContainsString("Please enter a valid email address.", $htmlContent);
    }

    public function testContactNewInvalidPhone()
    {
        // $this->markTestSkipped('must be revisited.');
        $this->logIn();
        $crawler = $this->client->request('GET', '/contacts/new');

        $form = $crawler->selectButton('Save')->form([
            'contacts[name]' => 'Bindiya Patel',
            'contacts[email]' => 'bindiya@patel.test',
            'contacts[phone]' => '1234567890',
            'contacts[message]' => 'Hello, this is a test message.',
        ]);

        $this->client->submit($form);
        $htmlContent = $this->client->getResponse()->getContent();
        $this->assertStringContainsString("Please enter a valid phone number (XXX-XXX-XXXX).", $htmlContent);
    }

    /**
     * Test the contact new entry functionality.
     *
     * @throws Exception when the test is skipped
     */
    public function testContactNewEntry()
    {
        // $this->markTestSkipped('must be revisited.');
        $this->logIn();
        $crawler = $this->client->request('GET', '/contacts/new');

        $form = $crawler->selectButton('Save')->form([
            'contacts[name]' => 'Bindiya Patel',
            'contacts[email]' => 'bindiya@patel.test',
            'contacts[phone]' => '123-456-7890',
            'contacts[message]' => 'Hello, this is a test message.',
        ]);

        $this->client->submit($form);
        $response = $this->client->getResponse();

        $this->assertEquals("/contacts/", $response->headers->get('Location'));
    }

    /**
     * Test the functionality of the testContactEditEntry() function.
     *
     * @throws Exception If an error occurs during the test.
     */
    public function testContactEditEntry()
    {
        // $this->markTestSkipped('must be revisited.');
        $this->logIn();
        $contact = $this->createContactEntry();

        $contact_id = $contact->getId();
        $crawler = $this->client->request('GET', "/contacts/{$contact_id}/edit");

        $new_name = $contact->getName() . " 1";
        $form = $crawler->selectButton('Update')->form([
            'contacts[name]' => $new_name,
        ]);

        $this->client->submit($form);

        $contact = $this->contactRepository->findOneById($contact_id);
        $this->assertEquals($contact->getName(), $new_name);
    }

    public function testContactDeleteEntry()
    {
        // $this->markTestSkipped('must be revisited.');
        $this->logIn();
        $contact = $this->createContactEntry();

        $contact_id = $contact->getId();
        $crawler = $this->client->request('GET', "/contacts/{$contact_id}");
        $form = $crawler->selectButton('Delete')->form();
        $this->client->submit($form);

        $contact = $this->contactRepository->findOneById($contact_id);
        $this->assertNull($contact);
    }

    public function createContactEntry()
    {
        $contact = new Contacts();
        $contact->setName('Bindiya Patel');
        $contact->setEmail('bindiya@patel.com');
        $contact->setPhone('123-123-1234');
        $contact->setMessage("This is test message");

        $this->entityManager->persist($contact);
        $this->entityManager->flush();

        return $contact;
    }
}
