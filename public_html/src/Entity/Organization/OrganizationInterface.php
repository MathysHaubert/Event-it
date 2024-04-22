<?php

declare(strict_types=1);

namespace App\Entity\Organization;

use App\Entity\Status\Status;

interface OrganizationInterface
{
    public function getName(): string;

    public function setName(string $name): void;

    public function getId(): int;

    public function setId(int $id): void;

    public function getStatus(): Status;

    public function setStatus(Status $status): void;

    public static function createOrganizationFromArray(array $data): self;
}
