<?php

namespace JonHubbard1\LaravelMysqlSpatial\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class Point extends Type
{
    const POINT = 'point';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'point';
    }

    public function getName()
    {
        return self::POINT;
    }
}
