<?php

declare(strict_types=1);

namespace App\Entity\Organization;

use App\Trait\ApiTrait;

class Organization
{
    public function __construct(
        private int $id = 0,
        private string $name = '',
        private ?array $users = [],
        private ?array $reservations = [],
    ) {
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
        $data = $api->get($_ENV['API_URL'] . '/organization', $params);
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
        $data = $api->get($_ENV['API_URL'] . '/organization', $params);
        error_log("Organization :" . json_encode($data));

        if (isset($data['id'])) {
            return self::createOrganizationFromArray($data);
        }

        return null;
    }

    public static function createOrganizationFromArray(array $data): self
    {
        return new Organization(
            $data['id'] ?? 0,
            $data['name'] ?? '',
            $data['users'] ?? [],
            $data['reservations'] ?? [],
        );
    }
}

class Api {
    use ApiTrait;
}
