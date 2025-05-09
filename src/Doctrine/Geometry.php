<?php

namespace JonHubbard1\LaravelMysqlSpatial\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class Geometry extends Type
{
    const GEOMETRY = 'geometry';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'geometry';
    }

    public function getName()
    {
        return self::GEOMETRY;
    }
}
