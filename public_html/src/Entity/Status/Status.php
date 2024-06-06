<?php

namespace App\Entity\Status;

use App\Entity\User;
use App\Trait\Identifier;

class Status implements  StatusInterface
{
    use Identifier;

    public function __construct(
        private string $name = "",
        private int $user_id = -1
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

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

}
