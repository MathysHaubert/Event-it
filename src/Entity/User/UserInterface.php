<?php

declare(strict_types=1);

namespace App\Entity\User;

use \DateTime;
Use App\Entity\Client\Client;
Use App\Entity\Organization\Organization;s

interface UserInterface
{
    public function getLastname(): string;
    public function setLastname(string $lastname): void;

    public function getFirstname(): string;

    public function setFirstname(string $firstname): void;
    public function getCreateAt(): DateTime;

    public function setCreateAt(DateTime $createAt): void;
    public function getLastConnection(): DateTime;
    public function setLastConnection(DateTime $lastConnection): void;

    public function getClient(): Client;

    public function setClient(Client $client): void;
    public function getPassword(): string;

    public function setPassword(string $password): void;

    public function getEmail(): string;

    public function setEmail(string $email): void;

    public function getOrganization(): Organization;

    public function setOrganization(Organization $organization): void;
}
