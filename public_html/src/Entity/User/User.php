<?php

namespace App\Entity\User;

use App\Entity\Client\Client;
use App\Entity\Organization\Organization;
use App\Trait\ApiTrait;
use App\Trait\Identifier;
use DateTime;

class User
{
    use Identifier;

    private ?string $jwt;
    public function __construct(
        private string $lastname = '',
        private string $firstname = '',
        private ?DateTime $createAt = null,
        private ?DateTime $lastConnection = null,
        private string $password = '',
        private string $email = '',
        private ?Organization $organization = null,
        $jwt = null,
    ) {
        $this->jwt = $jwt;
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

    public function getJwt(): string
    {
        return $this->jwt;
    }

    public function setJwt(string $jwt): void
    {
        $this->jwt = $jwt;
    }


    private static function createUserFromArray(array $data): User
    {
        return new User(
            $data['lastName'],
            $data['firstName'],
            isset($data['createdAt']['date']) ? new DateTime($data['createdAt']['date']) : null,
            isset($data['lastConnection']['date']) ? new DateTime($data['lastConnection']['date']) : null,
            $data['password'] ?? '',
            $data['email'],
            isset($data['organization']) ? Organization::createOrganizationFromArray($data['organization']) : null,
            $data['token'] ?? null,
        );
    }

    public static function getUser(array $params): array    //todo: this is ugly af and need to be fixed asap but no time
    {
    $api = new Api();
    $data = $api->get($_ENV['API_URL'].'/user', $params); //todo : replace url with env variable
    $users = [];
    foreach ($data as $userData) {
        $user = self::createUserFromArray($userData);
        $users[] = $user;
    }
    return $users;
    }

    public static function setLogin(array $params): User
    {
        $api = new Api();
        $data = $api->post($_ENV['API_URL'].'/login', $params);
        return self::createUserFromArray($data);
    }

    public static function createUser($data)
    {
        $api = new Api();
        $response = $api->post("http://176.147.224.139:8088".'/user', $data); //todo : replace url with env variable

        // Add logging here
        error_log(print_r($response, true));

        if($response){
            $user = self::createUserFromArray($data);
            return $user;
        }
        return null;
    }
}

class Api {
    use ApiTrait;
}
