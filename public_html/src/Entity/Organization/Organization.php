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
    use Identifier;

    public function __construct(
        private string $name = '',
        private int $orgId = -1,
        private ?User $users = null,
    ){
        $this->users = $users ?? new User();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }

    public static function getOrganization(array $params)
    {
        $api = new Api();
        $data = $api->get($_ENV['API_URL'].'/organization', $params); //todo : replace url with env variable
        $organizations = [];
    
        foreach ($data as $organizationData) {
            $organization = self::createorganizationFromArray($organizationData);
            $organizations[] = $organization;
        }
    
        return $organizations;
    }

    public static function createOrganizationFromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['id'],
        );
    }
}

class Api {
    use ApiTrait;
}