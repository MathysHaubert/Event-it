<?php

namespace App\Entity\Status;

use App\Entity\User;

interface StatusInterface
{
    public function getName(): string;

    public function setName(string $name): void;

    public function getUser(): User;

    public function setUser(User $user): void;
}
