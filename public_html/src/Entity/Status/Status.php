<?php

namespace App\Entity\Status;

use App\Entity\User;
use App\Trait\Identifier;

class Status implements  StatusInterface
{
    use Identifier;

    private string $name;

    private User $user;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}
