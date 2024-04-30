<?php

declare(strict_types=1);

namespace App\Entity\Organization;

use App\Trait\Identifier;

class Organization
{
    use Identifier;

    private string $name;

    private Status $status;
}
