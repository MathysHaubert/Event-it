<?php 

declare(strict_types=1);

namespace App\Trait;
trait Identifier
{
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}