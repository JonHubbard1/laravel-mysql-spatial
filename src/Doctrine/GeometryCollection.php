<?php

namespace JonHubbard1\LaravelMysqlSpatial\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class GeometryCollection extends Type
{
    const GEOMETRYCOLLECTION = 'geometrycollection';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'geometrycollection';
    }

    public function getName()
    {
        return self::GEOMETRYCOLLECTION;
    }
}
