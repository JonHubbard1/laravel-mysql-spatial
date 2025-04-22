<?php

namespace JonHubbard1\LaravelMysqlSpatial\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class Polygon extends Type
{
    const POLYGON = 'polygon';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'polygon';
    }

    public function getName()
    {
        return self::POLYGON;
    }
}
