<?php

namespace App\Entity;

use DateTime;

class User
{
    private int $id;
    private string $lastName;
    private string $firstName;
    private DateTime $createdAt;
    private DateTime $lastConnection;
    private int $clientId;
    private string $password;
    private string $email;
    private int $organizationId;

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

    
}