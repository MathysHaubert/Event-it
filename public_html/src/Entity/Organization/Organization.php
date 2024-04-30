<?php

declare(strict_types=1);

namespace App\Entity\Organization;

use App\Entity\Status\Status;
use App\Trait\Identifier;

class Organization
{
    use Identifier;

    public function __construct(
        private string $name,
        private int $id,
        private Status $status
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

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }

    public static function createOrganizationFromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['id'],
            $data['status']
        );
    }
}
