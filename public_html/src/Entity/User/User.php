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
        private int $userId = 0,
        private string $lastname = '',
        private string $firstname = '',
        private ?DateTime $createAt = null,
        private ?DateTime $lastConnection = null,
        private string $password = '',
        private string $email = '',
        private ?Organization $organization = null,
        private string $role = '',
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

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
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

    public function getOrganization(): ?Organization
    {
        return $this->organization;
    }

    public function setOrganization(?Organization $organization): void
    {
        $this->organization = $organization;
    }

    public function setOrganizationId(int $organizationId): void
    {
        $organization = Organization::getOrganization(['id' => $organizationId]);
        $this->organization = $organization[0];
    }

    public function getJwt(): string
    {
        return $this->jwt;
    }

    public function setJwt(string $jwt): void
    {
        $this->jwt = $jwt;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }


    private static function createUserFromArray(array $data): User
    {
        return new User(
            $data['id'],
            $data['lastName'],
            $data['firstName'],
            isset($data['createdAt']['date']) ? new DateTime($data['createdAt']['date']) : null,
            isset($data['lastConnection']['date']) ? new DateTime($data['lastConnection']['date']) : null,
            $data['password'] ?? '',
            $data['email'],
            isset($data['organization']) ? Organization::createOrganizationFromArray($data['organization']) : null,
            $data['role'],
            $data['token'] ?? null,
        );
    }

    public static function getUser(array $params)
    {
    $api = new Api();
    $data = $api->get($_ENV['API_URL'].'/user', $params); //todo : replace url with env variable
    $users = [];

    foreach ($data as $userData) {
        $user = self::createUserFromArray($userData);
        $users[] = $user;
    }

    return (count($users) > 1) ? $users : $users[0];
    }

    public static function createUser($data)
    {
        $api = new Api();
        $response = $api->post("http://176.147.224.139:8088".'/user', $data); //todo : replace url with env variable

        if($response){
            $user = self::createUserFromArray($data);
            return $user;
        }
        return null;
    }

    public static function login($data)
    {
        $api = new Api();
        $response = $api->post("http://176.147.224.139:8088".'/login', $data);
        if($response){
            $user = self::createUserFromArray($response, true);
            $_SESSION['jwt'] = $user->getJwt();
            return $user;
        }
        return null;
    }

    public static function getCurrentUser() {
        if(!isset($_SESSION['jwt'])){
            return;
        }
        $api = new Api();

        $currentUser = $api->get($_ENV['API_URL'].'/currentUser', null, $_SESSION['jwt']);

        if(!$currentUser) return;

        return self::createUserFromArray($currentUser);
    }

    public static function updateUser($data)
    {
        error_log(json_encode($data));
        $api = new Api();
        return $api->patch($_ENV['API_URL'] . '/user', $data, $_SESSION['jwt']);
    }
}

class Api {
    use ApiTrait;
}
