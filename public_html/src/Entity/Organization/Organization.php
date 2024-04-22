<?php

declare(strict_types=1);

namespace App\Entity\Organization;

use App\Trait\Identifier;

class Organization
{
    use Identifier;

    public function __construct(
        private string $name,
        private int $id,
        private int $status_id
    ){
    }
}
