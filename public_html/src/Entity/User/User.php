<?php

namespace App\Entity;

use App\Entity\Client\Client;
use App\Trait\Identifier;
use App\Entity\Organization\Organization;
use DateTime;
use Dotenv\Dotenv;

class User
{
    use Identifier;

    public function __construct(
        private string $lastname,
        private string $firstname,
        private DateTime $createAt,
        private DateTime $lastConnection,
        private string $password,
        private string $email,
        private Organization $organization
    ) {
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getCreateAt(): DateTime
    {
        return $this->createAt;
    }

    public function setCreateAt(DateTime $createAt): void
    {
        $this->createAt = $createAt;
    }

    public function getLastConnection(): DateTime
    {
        return $this->lastConnection;
    }

    public function setLastConnection(DateTime $lastConnection): void
    {
        $this->lastConnection = $lastConnection;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getOrganization(): Organization
    {
        return $this->organization;
    }

    public function setOrganization(Organization $organization): void
    {
        $this->organization = $organization;
    }
    
    private static function createUserFromArray(array $data): User
    {
        return new User(
            $data['lastname'],
            $data['firstname'],
            new DateTime($data['createAt']),
            new DateTime($data['lastConnection']),
            $data['password'],
            $data['email'],
            Organization::createOrganizationFromArray($data['organization'])
        );
    }

    public static function getUser(param $array): User
    {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        $ApiUrl = $_ENV['API_URL'];
        $data = ApiTrait::get($ApiUrl.'/user', null, $param);
        return self::createUserFromArray($data);
    }
}