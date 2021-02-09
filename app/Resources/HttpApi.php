<?php

namespace App\Resources;

use Spatie\DataTransferObject\DataTransferObject;

class HttpApi extends DataTransferObject
{
    public string $name;
    public int $memorySize;
    public int $timeout;
    public int $reservedConcurrency;
    public int $provisionedConcurrency;
    public bool $warmerEnabled;
}
