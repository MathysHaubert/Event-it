<?php

namespace App\Entity;

use DateTime;
use App\Entity\Client;
use App\Entity\Organization;
use App\Entity\User\UserInterface;

class User implements UserInterface
{

use Identifier;
    private string $lastName;
    private string $firstName;
    private DateTime $createdAt;
    private DateTime $lastConnection;
    private Client $client;
    private string $password;
    private string $email;
    private Organization $organization;

    public function __construct(
        int $id,
        string $lastName,
        string $firstName,
        DateTime $createdAt,
        DateTime $lastConnection,
        int $clientId,
        string $password,
        string $email,
        int $organizationId
    ) {
        $this->id = $id;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->createdAt = $createdAt;
        $this->lastConnection = $lastConnection;
        $this->clientId = $clientId;
        $this->password = $password;
        $this->email = $email;
        $this->organizationId = $organizationId;
    }


    public function __toString()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of organizationId
     */
    public function getOrganizationId()
    {
        return $this->organizationId;
    }

    /**
     * Set the value of organizationId
     *
     * @return  self
     */
    public function setOrganizationId($organizationId)
    {
        $this->organizationId = $organizationId;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of clientId
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set the value of clientId
     *
     * @return  self
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get the value of lastConnection
     */
    public function getLastConnection()
    {
        return $this->lastConnection;
    }

    /**
     * Set the value of lastConnection
     *
     * @return  self
     */
    public function setLastConnection($lastConnection)
    {
        $this->lastConnection = $lastConnection;

        return $this;
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }
}
