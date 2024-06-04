<?php

declare(strict_types=1);

namespace App\Entity\Organization;

use App\Entity\Status\Status;
use App\Trait\Identifier;
use App\Trait\ApiTrait;
use App\Entity\User\User;
use App\Entity\Reservation\Reservation;

class Organization
{

    public function __construct(
        private int $id = 0,
        private string $name = '',
        private ?array $users = [],
        private ?array $reservations = [],
    ){
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public static function getOrganization(array $params = null)
    {
        $api = new Api();
        $data = $api->get($_ENV['API_URL'].'/organization', $params); //todo : replace url with env variable
        $organizations = [];

        foreach ($data as $organizationData) {
            $organization = self::createOrganizationFromArray($organizationData);
            $organizations[] = $organization;
        }

            return $organizations;
    }

    public static function getOrganizationById(array $params)
    {
        $api = new Api();
        $data = $api->get($_ENV['API_URL'].'/organization', $params); //todo : replace url with env variable

        if (is_array($data) && count($data) > 0) {
            return self::createOrganizationFromArray($data[0]);
        }

        return null;
    }

    public static function createOrganizationFromArray(array $data): self
    {
        return new Organization(
            $data['id'],
            $data['name'],
            $data['users'],
            $data['reservations'],
        );
    }
}

class Api {
    use ApiTrait;
}
