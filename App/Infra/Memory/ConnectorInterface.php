<?php

declare(strict_types=1);

namespace App\Infra\Memory;

use App\Elo\Word;

interface ConnectorInterface
{
    public static function findWord(): Word;
}
