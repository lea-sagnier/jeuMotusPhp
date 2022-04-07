<?php

declare(strict_types=1); 

namespace App\Controller;

use App\Infra\Memory\DbSelector;

class Toto implements Controller
{
    public function render()
    {
        echo 'Toto'
    }
}
